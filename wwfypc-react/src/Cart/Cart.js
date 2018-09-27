import React, {Component} from 'react';
import Button from '../Shared/Buttons';
import Footer from "../Shared/Footer/Footer";
import "./style/Cart.scss";

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

        this.state = {
            num: this.props.num,
        };

        this.increment = this.increment.bind(this);
        this.decrement = this.decrement.bind(this);
        this.setNum = this.setNum.bind(this);
    }

    increment() {
        this.props.onChange(this.props.num + 1);
    }

    decrement() {
        let newVal = this.props.num - 1;
        if (newVal <= 1) newVal = 1;
        this.props.onChange(newVal);
    }

    setNum(event) {
        let newVal = parseInt(event.target.value);
        if (!isNaN(newVal)) {
            if (newVal <= 1) newVal = 1;
            this.props.onChange(newVal);
        } else {
            this.props.onChange(this.props);
        }
    }

    render() {
        return <div className="Quantity">
            <i className={"fas fa-minus" + (this.props.num <= 1 ? " disabled" : "")} onClick={this.decrement}/>
            <input type="text" size={2} value={this.props.num} onChange={this.setNum}/>
            <i className="fas fa-plus" onClick={this.increment}/>
        </div>
    }
}

class Item extends Component {
    render() {
        return [
            <div key={0} className="Img">
                <img src={this.props.item.image} alt=""/>
                <Button colour={5} small>Remove</Button>
            </div>,
            <div key={1} className="ItemInfo">
                <span className="name">{this.props.item.name}</span>
                <ul>
                    {
                        this.props.item.details.map((detail, i) => <li key={i}>{detail}</li>)
                    }
                </ul>
            </div>,
            <Quantity num={this.props.item.quantity} onChange={this.props.onUpdateNum} key={2}/>,
            <div className="price" key={3}>
                <span>&pound;{(this.props.item.quantity * this.props.item.price).toFixed(2)}</span>
                <form>
                    {
                        this.props.item.delivery.map((option, i) => {
                            let price = "";

                            if (option.cost > 0) {
                                price = " (+£" + option.cost.toFixed(2) + ")";
                            }

                            return [
                                <input key={0} type="radio" value={"delivery-" + i}
                                       checked={this.props.item.selectedDelivery === i}
                                       onChange={() => this.props.onDeliveryChange(i)}
                                />,
                                <label key={1}>{option.name + price}</label>
                            ]
                        })
                    }
                </form>
            </div>,
        ]
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
    render() {
        const price = this.props.cart.reduce((prev, item) => prev + item.price * item.quantity, 0);
        const postage = this.props.cart.reduce((prev, item) =>
            prev + item.delivery[item.selectedDelivery].cost * item.quantity, 0);
        const total = price + postage;

        return <div className="price">
            <span>Price:</span>
            <span>&pound;{price.toFixed(2)}</span>
            <span>Postage:</span>
            <span>&pound;{postage.toFixed(2)}</span>
            <span>Total:</span>
            <span>&pound;{total.toFixed(2)}</span>
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