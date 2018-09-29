import React, {Component} from 'react';
import {Link} from 'react-router-dom';
import Button from '../Shared/Buttons';
import './style/Success.scss';

export default class Success extends Component {
    render() {
        return <div className="CartSuccess">
            <h1>Success!</h1>
            <p>
              You should receive an email conformation shortly.
            </p>
            <Link to="/">
                <Button colour={6}>Back to main page</Button>
            </Link>
        </div>
    }
}