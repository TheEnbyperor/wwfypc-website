import React, {Component} from 'react';
import CartIndicator from '../Cart/Indicator/Indicator';
import './style/BottomBar.scss';

class Contact extends Component {
    render() {
        return (
            <div className="ContactButton">
                <span>Contact</span>
            </div>
        );
    }
}

export default class BottomBar extends Component {
    render() {
        return (
            <div className="BottomBar">
                <div>
                    <CartIndicator/>
                    <Contact/>
                </div>
            </div>
        )
    }
}