import React, {Component} from 'react';
import {BASE_URL} from "../../App";
import './style/Top.scss';

export default class Top extends Component {
    render() {
        return (
            <header className="Service-Top" style={{
                backgroundImage: `url(${BASE_URL + this.props.background})`
            }}>
            </header>
        )
    }
}