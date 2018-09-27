import React, {Component} from 'react';
import gql from 'graphql-tag';
import {Query} from 'react-apollo';
import Button from '../Shared/Buttons';
import Footer from "../Shared/Footer/Footer";
import {BASE_URL, client} from "../App";
import "./style/Cart.scss";

const ITEM_QUERY = gql`
  query($type: ID!, $id: ID!) {
    cartItem(category: $type, id: $id) {
      name
      price
      quantityAvailable
      image
      specs {
        name
        value
      }
      deliveries {
        id
        name
        price
      }
    }
  }
`;

const ITEM_PRICE_QUERY = gql`
  query($type: ID!, $id: ID!) {
    cartItem(category: $type, id: $id) {
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

class Quantity extends Component {
    constructor(props) {
        super(props);

        this.increment = this.increment.bind(this);
        this.decrement = this.decrement.bind(this);
        this.setNum = this.setNum.bind(this);
    }

    increment() {
        let newVal = this.props.num + 1;
        if (newVal >= this.props.max) newVal = this.props.max;
        this.props.onChange(newVal);
    }

    decrement() {
        let newVal = this.props.num - 1;
        if (newVal <= 1) newVal = 1;
        this.props.onChange(newVal);
    }

    setNum(event) {
        let newVal = parseInt(event.target.value, 10);
        if (!isNaN(newVal)) {
            if (newVal <= 1) newVal = 1;
            if (newVal >= this.props.max) newVal = this.props.max;
            this.props.onChange(newVal);
        } else {
            this.props.onChange(this.props.num);
        }
    }

    render() {
        const val = parseInt(this.props.num, 10);
        return <div className="Quantity">
            <i className={"fas fa-minus" + (this.props.num <= 1 ? " disabled" : "")} onClick={this.decrement}/>
            <input type="text" size={2} value={isNaN(val) ? 1 : val} onChange={this.setNum}/>
            <i className={"fas fa-plus" + (this.props.num >= this.props.max ? " disabled" : "")}
               onClick={this.increment}/>
        </div>
    }
}

class Item extends Component {
    render() {
        return <Query query={ITEM_QUERY} variables={{type: this.props.item.type, id: this.props.item.id}}>
            {({data, loading, error}) => {
                if (loading) return null;
                if (error) return <h2>Error</h2>;

                return [
                    <div key={0} className="Img">
                        <img src={BASE_URL + data.cartItem.image} alt=""/>
                        <Button colour={5} small>Remove</Button>
                    </div>,
                    <div key={1} className="ItemInfo">
                        <span className="name">{data.cartItem.name}</span>
                        <ul>
                            {data.cartItem.specs.map((detail, i) =>
                                <li key={i}>{detail.name}: {detail.value}</li>
                            )}
                        </ul>
                    </div>,
                    <Quantity num={this.props.item.quantity} max={data.cartItem.quantityAvailable}
                              onChange={this.props.onUpdateNum} key={2}/>,
                    <div className="price" key={3}>
                        <span>&pound;{(this.props.item.quantity * data.cartItem.price).toFixed(2)}</span>
                        <form>
                            {
                                data.cartItem.deliveries.map((option) => {
                                    let price = "";

                                    if (option.price > 0) {
                                        price = " (+£" + option.price.toFixed(2) + ")";
                                    }

                                    return [
                                        <input key={0} type="radio" value={"delivery-" + option.id}
                                               checked={this.props.item.selectedDelivery === option.id}
                                               onChange={() => this.props.onDeliveryChange(option.id)}
                                        />,
                                        <label key={1}>{option.name + price}</label>
                                    ]
                                })
                            }
                        </form>
                    </div>,
                ]
            }}
        </Query>
    }
}

class Items extends Component {
    constructor(props) {
        super(props);

        this.updateItemNum = this.updateItemNum.bind(this);
        this.updateItemDelivery = this.updateItemDelivery.bind(this);
    }


    updateItemNum(i, num) {
        this.props.cart[i].quantity = num;
        this.props.onUpdate(this.props.cart)
    }

    updateItemDelivery(i, delivery) {
        this.props.cart[i].selectedDelivery = delivery;
        this.props.onUpdate(this.props.cart)
    }

    render() {
        return <div className="Items">
            <h3>Item</h3>
            <h3>Quantity</h3>
            <h3>Price</h3>
            {
                this.props.cart.map((item, i) => {
                    return [
                        <Item key={0} item={item} onUpdateNum={(num) => this.updateItemNum(i, num)}
                              onDeliveryChange={(delivery) => this.updateItemDelivery(i, delivery)}/>,
                        <hr key={1}/>,
                    ]
                })
            }
        </div>
    }
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
        this.props.cart.reduce(async (prev, item) => {
            const {data} = await client.query({
                query: ITEM_PRICE_QUERY,
                variables: {type: item.type, id: item.id},
            });
            const delivery = data.cartItem.deliveries.find(elm => elm.id === item.selectedDelivery);
            const prev2 = await prev;
            return [prev2[0] + data.cartItem.price * item.quantity, prev2[1] + delivery.price * item.quantity];
        }, [0, 0]).then(price => {
            this.setState({
                price: price[0],
                postage: price[1],
                total: price[0] + price[1],
            });
        });
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
        };

        this.onUpdate = this.onUpdate.bind(this);
    }

    componentDidMount() {
        new window.fullpage(".Cart", {
            anchors: ["cart", "footer"],
            navigationTooltips: ["Cart", "Footer"],
            navigationPosition: 'right',
            navigation: true,
            licenseKey: "OPEN-SOURCE-GPLV3-LICENSE",
            scrollOverflow: true,
        })
    }

    componentWillUnmount() {
        window.fullpage_api.destroy('all');
    }

    onUpdate(cart) {
        localStorage.setItem("cart", JSON.stringify(cart));
        this.setState({
            cart: cart
        });
    }

    render() {
        return <div className="Cart">
            <div className="section CartInner">
                <div className="inner">
                    <div className="left">
                        <h1>My cart</h1>
                        <Items cart={this.state.cart} onUpdate={this.onUpdate}/>
                    </div>
                    <div className="right">
                        <PriceTotal cart={this.state.cart}/>
                        <Button colour={3}>Checkout</Button>
                    </div>
                </div>
            </div>
            <div className="section fp-auto-height"><Footer/></div>
        </div>;
    }
}