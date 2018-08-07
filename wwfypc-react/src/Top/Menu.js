import React, { Component } from 'react';
import './style/Menu.scss';

export default class Top extends Component {
    render() {
        return (
            <nav className="Menu">
                <div>
                    <a href="#">Services</a>
                    <div>
                        <a href="#">Computers</a>
                        <a href="#">iPhones</a>
                        <a href="#">iPads</a>
                        <a href="#">Unlocking</a>
                        <a href="#">VHS</a>
                        <a href="#">Buy & Sell</a>
                    </div>
                </div>
                <div>
                    <a href="#about">About Us</a>
                </div>
                <div>
                    <a href="#">Buy & Sell</a>
                </div>
                <div>
                    <a href="">Contact</a>
                </div>
            </nav>
        )
    }
}