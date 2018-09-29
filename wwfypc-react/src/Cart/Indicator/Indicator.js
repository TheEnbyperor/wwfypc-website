import React, {Component} from 'react';
import {Link} from 'react-router-dom';
import {getCart, bindUpdateCart} from "../Cart";
import './Indicator.scss';

export default class CartIndicator extends Component {
    constructor(props) {
        super(props);

        this.state = {
            cart: getCart()
        };
    }

    componentWillMount() {
        bindUpdateCart((cart) => {
            this.setState({
                cart: cart,
            })
        });
    }

    render() {
        return <Link to="/cart">
            <div className="CartIndicator">
                <i className="fas fa-shopping-cart"/>
                <div className="num">
                    {this.state.cart.reduce((prev, item) => prev + item.quantity, 0)}
                </div>
            </div>
        </Link>
    }
}