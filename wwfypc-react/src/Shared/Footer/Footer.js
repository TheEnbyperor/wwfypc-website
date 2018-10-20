import React, {Component} from 'react';
import {Query} from "react-apollo";
import gql from "graphql-tag";
import "./Footer.scss";
import {Link} from "react-router-dom";

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
    }
    servicePages {
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
                                        <span>{data.siteConfig.landline}</span>
                                        <span>{data.siteConfig.mobile}</span>
                                        <span>{data.siteConfig.email}</span>
                                        <p dangerouslySetInnerHTML={{__html: data.siteConfig.address}} />
                                    </div>

                                    <div>
                                        <a href="">Sitemap</a>
                                        <a href="">Terms & conditions</a>
                                        <a href="">Warranty</a>
                                        <a href="">Report a bug</a>

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