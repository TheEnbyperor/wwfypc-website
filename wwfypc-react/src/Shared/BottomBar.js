import React, {Component} from 'react';
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
                    <Contact/>
                </div>
            </div>
        )
    }
}