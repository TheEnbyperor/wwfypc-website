import React, { Component } from 'react';
import Logo from './img/logo.png';
import './style/Menu.scss';
import {Link, withRouter} from 'react-router-dom';

class hashLink extends Component {
    render() {
        if (this.props.location.pathname === this.props.to) {
            return <a href={this.props.hash}>{this.props.children}</a>;
        } else {
            return <Link to={this.props.to + this.props.hash}>{this.props.children}</Link>;
        }
    }
}

const HashLink = withRouter(hashLink);

export default class Top extends Component {
    render() {
        return (
            <nav className="Menu">
                <a href="/" className="img">
                    <img src={Logo} alt=""/>
                </a>
                <div>
                    <a href="">Services</a>
                    <div>
                        <a href="">Computers</a>
                        <a href="">iPhones</a>
                        <a href="">iPads</a>
                        <a href="">Unlocking</a>
                        <a href="">VHS</a>
                        <a href="">Buy & Sell</a>
                    </div>
                </div>
                <div>
                    <HashLink to="/" hash="#about">About Us</HashLink>
                </div>
                <div>
                    <Link to="/buy-and-sell">Buy & Sell</Link>
                </div>
                <div>
                    <a href="">Contact</a>
                </div>
            </nav>
        )
    }
}