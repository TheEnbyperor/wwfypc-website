import React, {Component} from 'react';
import gql from 'graphql-tag';
import Button from '../Shared/Buttons';
import Footer from "../Shared/Footer/Footer";
import Items from './Item';
import Payment from './Payment';
import Success from './Success';
import {client} from "../App";
import "./style/Cart.scss";
import DocumentTitle from "react-document-title";

export const ITEM_PRICE_QUERY = gql`
  query($type: ID!, $id: ID!) {
    cartItem(category: $type, item: $id) {
      price
      deliveries {
        id
        price
      }
    }
  }
`;

export function getCart() {
    let cart;
    try {
        cart = JSON.parse(localStorage.getItem("cart"));
    } catch (e) {
        cart = [];
    }

    if (!Array.isArray(cart)) {
        cart = [];
    }
    return cart;
}

const cartUpdateCallbacks = [];

export function bindUpdateCart(callback) {
    cartUpdateCallbacks.push(callback);
}

function updateCart(cart) {
    localStorage.setItem("cart", JSON.stringify(cart));
    cartUpdateCallbacks.forEach((callback) => callback(cart));
}

export function getItem(type, id) {
    const cart = getCart();

    return cart.find(elm => elm.type === type && elm.id === id);
}

export function addToCart(type, id) {
    const cart = getCart();

    const inCart = cart.findIndex(elm => elm.type === type && elm.id === id);
    if (inCart !== -1) {
        cart[inCart].quantity += 1;
    } else {
        cart.push({
            type: type,
            id: id,
            selectedDelivery: null,
            quantity: 1,
        });
    }
    updateCart(cart);
}

export function removeFromCart(type, id) {
    const cart = getCart();

    const inCart = cart.findIndex(elm => elm.type === type && elm.id === id);
    if (inCart !== -1) {
        cart.splice(inCart, 1);
        updateCart(cart);
    }
    return cart;
}

class PriceTotal extends Component {
    constructor(props) {
        super(props);

        this.state = {
            price: 0,
            postage: 0,
            total: 0,
            lastCart: JSON.parse(JSON.stringify(props.cart)),
            loadNewData: false,
        }
    }

    calcPrice() {
        if (this.props.cart.length > 0) {
            this.props.cart.reduce(async (prev, item) => {
                const {data} = await client.query({
                    query: ITEM_PRICE_QUERY,
                    variables: {type: item.type, id: item.id},
                    fetchPolicy: "network-only",
                });
                let delivery = {price:0};
                if (data.cartItem.deliveries.length === 1) {
                    delivery = data.cartItem.deliveries[0];
                } else if (data.cartItem.deliveries.length > 1) {
                    delivery = data.cartItem.deliveries.find(elm => elm.id === item.selectedDelivery);
                }
                const prev2 = await prev;
                return [prev2[0] + data.cartItem.price * item.quantity, prev2[1] + delivery.price * item.quantity];
            }, [0, 0]).then(price => {
                this.setState({
                    price: price[0],
                    postage: price[1],
                    total: price[0] + price[1],
                });
            }).catch(error => console.error(error));
        }
    }

    componentDidMount() {
        this.calcPrice()
    }

    componentDidUpdate() {
        if (this.state.loadNewData === true) {
            this.setState({
                loadNewData: false,
            });
            this.calcPrice();
        }
    }

    static getDerivedStateFromProps(props, state) {
        if (JSON.stringify(props.cart) !== JSON.stringify(state.lastCart)) {
            return {
                lastCart: JSON.parse(JSON.stringify(props.cart)),
                loadNewData: true,
            };
        }

        return null;
    }

    render() {
        return <div className="price">
            <span>Price:</span>
            <span>&pound;{this.state.price.toFixed(2)}</span>
            <span>Postage:</span>
            <span>&pound;{this.state.postage.toFixed(2)}</span>
            <span>Total:</span>
            <span>&pound;{this.state.total.toFixed(2)}</span>
        </div>;
    }
}

export default class Cart extends Component {
    constructor(props) {
        super(props);

        this.state = {
            cart: getCart(),
            state: 0,
            cartIsReady: false,
        };

        this.onUpdate = this.onUpdate.bind(this);
        this.onComplete = this.onComplete.bind(this);
    }

    componentDidMount() {
        new window.fullpage(".Cart", {
            anchors: ["cart", "footer"],
            navigationTooltips: ["Cart", "Footer"],
            navigationPosition: 'right',
            navigation: true,
            licenseKey: "OPEN-SOURCE-GPLV3-LICENSE",
        });
        this.cartIsReady();
    }

    componentWillUnmount() {
        window.fullpage_api.destroy();
    }

    onUpdate(cart) {
        updateCart(cart);
        this.cartIsReady();
        this.setState({
            cart: cart
        });
    }

    cartIsReady() {
        this.state.cart.reduce(async (prev, item) => {
            const {data} = await client.query({
                query: ITEM_PRICE_QUERY,
                variables: {type: item.type, id: item.id},
            });
            if (data.cartItem.deliveries.length > 1 && item.selectedDelivery === null)
                return false;

            return prev;
        }, Promise.resolve(true)).then(res => {
            if (this.state.cart.length > 0) {
                this.setState({
                    cartIsReady: res
                })
            } else {
                this.setState({
                    cartIsReady: false
                })
            }
        });
    }

    onComplete() {
        this.setState({
            state: 2,
            cart: [],
        });
        updateCart([]);
    }

    render() {
        let left = null;
        let right = null;

        if (this.state.state === 0) {
            left = <Items cart={this.state.cart} onUpdate={this.onUpdate}/>;
            right = this.state.cartIsReady ?
                <Button colour={3} onClick={() => this.setState({state: 1})}>Checkout</Button> :
                <h3>Please complete the cart</h3>;
        } else if (this.state.state === 1) {
            left = <Payment cart={this.state.cart} onSubmit={this.onComplete}/>;
        } else if (this.state.state === 2) {
            left = <Success/>;
        }

        return <DocumentTitle title="Cart | We Will Fix Your PC">
            <div className="Cart">
                <div className={"section CartInner" + (this.state.state === 2 ? " orange" : "")}>
                    <div className="inner">
                        <div className="left">
                            {left}
                        </div>
                        <div className="right">
                            <PriceTotal cart={this.state.cart}/>
                            {right}
                        </div>
                    </div>
                </div>
                <div className="section fp-auto-height" style={{
                    paddingBottom: 70,
                }}><Footer/></div>
            </div>
        </DocumentTitle>;
    }
}