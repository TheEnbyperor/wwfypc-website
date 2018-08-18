import React, {Component} from 'react';
import {Query} from "react-apollo";
import gql from "graphql-tag";
import "./Footer.scss";

const INFO_QUERY = gql`
  {
    siteConfig {
      landline
      mobile
      address
      email
    }
  }
`;

export default class Footer extends Component {
    render() {
        return (
            <div className="Footer">
                <Query query={INFO_QUERY}>
                    {({loading, error, data}) => {
                        if (!loading && !error) {
                            return (
                                <div>
                                    <h2>Repairs</h2>
                                    <h2>Contact</h2>
                                    <h2>Legal</h2>

                                    <div>
                                        <a href="">Laptops & Computers</a>
                                        <a href="">Apple Macs</a>
                                        <a href="">iPhones</a>
                                        <a href="">iPads</a>
                                        <a href="">Apple Watches</a>
                                        <a href="">Unlocking</a>
                                        <a href="">Buying & selling</a>
                                    </div>

                                    <div>
                                        <span>{data.siteConfig.landline}</span>
                                        <span>{data.siteConfig.mobile}</span>
                                        <span>{data.siteConfig.email}</span>
                                        <p>{data.siteConfig.address}</p>
                                    </div>

                                    <div>
                                        <a href="">Sitemap</a>
                                        <a href="">Terms & conditions</a>
                                        <a href="">Warranty</a>
                                        <a href="">Report a bug</a>

                                        <div className="social">
                                            <i className="fab fa-facebook-f"/>
                                            <i className="fab fa-google"/>
                                            <i className="fab fa-twitter"/>
                                        </div>
                                    </div>
                                </div>
                            );
                        } else {
                            return null;
                        }
                    }}
                </Query>
            </div>
        );
    }
}