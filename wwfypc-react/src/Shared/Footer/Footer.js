import React, {Component} from 'react';
import {Query} from "react-apollo";
import gql from "graphql-tag";
import "./Footer.scss";
import {Link} from "react-router-dom";
import {BASE_URL} from "../../App";

const INFO_QUERY = gql`
  {
    siteConfig {
      landline
      mobile
      address
      email
      twitterUrl
      googleUrl
      facebookUrl
      termsAndConditions
      warranty
    }
    servicePages {
      id
      name
      url
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
                                        <Link to="/unlocking">Unlocking</Link>
                                        {data.servicePages.map((page, i) => {
                                            return <Link to={"/" + page.url} key={i}>{page.name}</Link>;
                                        })}
                                    </div>

                                    <div>
                                        <span>
                                            <a href={"tel:" + data.siteConfig.landline}>
                                                {data.siteConfig.landline}
                                            </a>
                                        </span>
                                        <span>
                                            <a href={"tel:" + data.siteConfig.mobile}>
                                                {data.siteConfig.mobile}
                                            </a>
                                        </span>
                                        <span>
                                            <a href={"mailto:" + data.siteConfig.email}>
                                                {data.siteConfig.email}
                                            </a>
                                        </span>
                                        <p dangerouslySetInnerHTML={{__html: data.siteConfig.address}}/>
                                    </div>

                                    <div>
                                        <a href={BASE_URL + data.siteConfig.termsAndConditions} target="_blank">
                                            Terms & conditions
                                        </a>
                                        <a href={BASE_URL + data.siteConfig.warranty} target="_blank">Warranty</a>

                                        <div className="social">
                                            <a href={data.siteConfig.facebookUrl} target="_blank">
                                                <i className="fab fa-facebook-f"/>
                                            </a>
                                            <a href={data.siteConfig.googleUrl} target="_blank">
                                                <i className="fab fa-google"/>
                                            </a>
                                            <a href={data.siteConfig.twitterUrl} target="_blank">
                                                <i className="fab fa-twitter"/>
                                            </a>
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