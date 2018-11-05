import React, {Component} from 'react';
import Logo from './img/logo.png';
import './style/Menu.scss';
import {Link, withRouter} from 'react-router-dom';
import {Query} from 'react-apollo';
import gql from 'graphql-tag';
import CartIndicator from '../Cart/Indicator/Indicator';

const MENU_QUERY = gql`
  query {
    menuItems {
      name
      linkTo
      anchor
    }
  }
`;

class hashLink extends Component {
    render() {
        if (this.props.location.pathname === this.props.to) {
            return <a href={this.props.hash} className={this.props.className}>{this.props.children}</a>;
        } else {
            return <Link to={this.props.to + this.props.hash}
                         className={this.props.className}>{this.props.children}</Link>;
        }
    }
}

export const HashLink = withRouter(hashLink);

export default class Top extends Component {
    render() {
        return (
            <div className="Menu">
                <nav>
                    <HashLink to="/" hash="#top" className="img">
                        <img src={Logo} alt=""/>
                    </HashLink>
                    <div>
                        <span>Services</span>
                        <Query query={MENU_QUERY}>
                            {({loading, error, data}) => {
                                if (loading || error) return null;

                                return (
                                    <div>
                                        {data.menuItems.map((page, i) => {
                                            return page.isLinkExternal ?
                                                <a href={page.linkTo + page.anchor} target="_blank">
                                                    {page.name}
                                                </a> :
                                                <HashLink to={page.linkTo} hash={page.anchor} key={i}>
                                                    {page.name}
                                                </HashLink>;
                                        })}
                                    </div>
                                );
                            }}
                        </Query>
                    </div>
                    <div>
                        <HashLink to="/" hash="#about">About Us</HashLink>
                    </div>
                    <div>
                        <Link to="/buy-and-sell">Buy & Sell</Link>
                    </div>
                    <div>
                        <Link to="/contact">Contact</Link>
                    </div>
                    <div className="cart">
                        <CartIndicator/>
                    </div>
                </nav>
            </div>
        )
    }
}