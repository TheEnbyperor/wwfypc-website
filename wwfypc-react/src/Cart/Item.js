import React, {Component} from "react";
import gql from 'graphql-tag';
import {Query} from "react-apollo";
import {BASE_URL} from "../App";
import Button from "../Shared/Buttons";
import {removeFromCart} from "./Cart";

const ITEM_QUERY = gql`
  query($type: ID!, $id: ID!) {
    cartItem(category: $type, item: $id) {
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

class Quantity extends Component {
    constructor(props) {
        super(props);

        this.increment = this.increment.bind(this);
        this.decrement = this.decrement.bind(this);
        this.setNum = this.setNum.bind(this);
    }

    increment() {
        let newVal = this.props.num + 1;
        if (newVal >= this.props.max && this.props.max !== -1) newVal = this.props.max;
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
            <i className={"fas fa-plus" + (this.props.num >= this.props.max && this.props.max !== -1 ? " disabled" : "")}
               onClick={this.increment}/>
        </div>
    }
}

class Item extends Component {
    constructor(props) {
        super(props);

        this.remove = this.remove.bind(this);
    }

    remove() {
        this.props.onRemove(removeFromCart(this.props.item.type, this.props.item.id));
    }

    render() {
        return <Query query={ITEM_QUERY} variables={{type: this.props.item.type, id: this.props.item.id}}>
            {({data, loading, error}) => {
                if (loading) return null;
                if (error) {
                    if (error.graphQLErrors[0].message === "Item matching query does not exist.") {
                        removeFromCart(this.props.item.type, this.props.item.id);
                    }
                    return <h2>Error</h2>;
                }

                setTimeout(() => {
                    window.$.scrollify.update();
                    window.$.scrollify.instantMove("#cart");
                }, 500);

                return [
                    <div key={0} className="Img">
                        <img src={BASE_URL + data.cartItem.image} alt=""/>
                        <Button colour={5} small onClick={this.remove}>Remove</Button>
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
                                               checked={this.props.item.selectedDelivery === option.id ||
                                               data.cartItem.deliveries.length <= 1}
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

export default class Items extends Component {
    constructor(props) {
        super(props);

        this.updateItemNum = this.updateItemNum.bind(this);
        this.updateItemDelivery = this.updateItemDelivery.bind(this);
        this.onRemove = this.onRemove.bind(this);
    }

    onRemove(cart) {
        console.log(cart);
        this.props.onUpdate(cart);
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
        return [
            <h1 key={0}>My cart</h1>,
            <div key={1} className="Items">
                <h3>Item</h3>
                <h3>Quantity</h3>
                <h3>Price</h3>
                {
                    this.props.cart.map((item, i) => {
                        return [
                            <Item key={0} item={item} onUpdateNum={(num) => this.updateItemNum(i, num)}
                                  onDeliveryChange={(delivery) => this.updateItemDelivery(i, delivery)}
                                  onRemove={this.onRemove}
                            />,
                            <hr key={1}/>,
                        ]
                    })
                }
            </div>
        ];
    }
}