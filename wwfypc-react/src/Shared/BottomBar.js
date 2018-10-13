import React, {Component} from 'react';
import CartIndicator from '../Cart/Indicator/Indicator';
import './style/BottomBar.scss';
import {Link} from 'react-router-dom';
import {Query} from "react-apollo";
import gql from 'graphql-tag';

const INFO_QUERY = gql`
  {
    siteConfig {
      twitterUrl
      googleUrl
      facebookUrl
    }
  }
`;

class Contact extends Component {
    render() {
        return (
                <Query query={INFO_QUERY}>
                    {({loading, error, data}) => {
                        if (!loading && !error) {
                            return <div className="ContactButton">
                                <span>Contact</span>
                                <a href={data.siteConfig.facebookUrl}><i className="fab fa-facebook-f"/></a>
                                <a href={data.siteConfig.googleUrl}><i className="fab fa-google"/></a>
                                <a href={data.siteConfig.twitterUrl}><i className="fab fa-twitter"/></a>
                                <Link to="/contact"><i className="fa fa-envelope"/></Link>
                            </div>
                        } else {
                            return null;
                        }
                    }}
                </Query>
        );
    }
}

export default class BottomBar extends Component {
    render() {
        return (
            <div className="BottomBar">
                <div>
                    <div>
                        <CartIndicator/>
                        <Contact/>
                    </div>
                </div>
            </div>
        )
    }
}