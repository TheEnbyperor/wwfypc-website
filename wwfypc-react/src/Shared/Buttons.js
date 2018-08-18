import React, {Component} from 'react';
import './style/Buttons.scss';

export default class Button extends Component {
    render() {
        return (
            <div className={"Button colour-" + this.props.colour + ((this.props.small) ? " small" : "")}>
                <div>{this.props.children}</div>
            </div>
        )
    }
}