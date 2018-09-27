import React, {Component} from 'react';
import {Link} from 'react-router-dom';
import {getCart} from "../Cart";
import './Indicator.scss';

export default class CartIndicator extends Component {
    render() {

        return <Link to="/cart">
            <div className="CartIndicator">
                <i className="fas fa-shopping-cart"/>
                <div className="num">
                    {getCart().length}
                </div>
            </div>
        </Link>
    }
}