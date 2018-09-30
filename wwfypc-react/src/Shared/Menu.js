import React, {Component} from 'react';
import Logo from './img/logo.png';
import './style/Menu.scss';
import {Link, withRouter} from 'react-router-dom';
import {Query} from 'react-apollo';
import gql from 'graphql-tag';

const SERVICES_QUERY = gql`
  query {
    servicePages {
      id
      name
      url
    }
  }
`;

class hashLink extends Component {
    render() {
        if (this.props.location.pathname === this.props.to) {
            return <a href={this.props.hash}>{this.props.children}</a>;
        } else {
            return <Link to={this.props.to + this.props.hash}>{this.props.children}</Link>;
        }
    }
};

export const HashLink = withRouter(hashLink);

export default class Top extends Component {
    render() {
        return (
            <div className="Menu">
                <nav>
                    <Link to="/" className="img">
                        <img src={Logo} alt=""/>
                    </Link>
                    <div>
                        <a href="">Services</a>
                        <Query query={SERVICES_QUERY}>
                            {({loading, error, data}) => {
                                if (loading || error) return null;

                                return (
                                    <div>
                                        {data.servicePages.map((page) => {
                                            return <Link to={"/" + page.url} key={page.id}>{page.name}</Link>;
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
                </nav>
            </div>
        )
    }
}