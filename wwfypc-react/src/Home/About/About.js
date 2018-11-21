import React, {Component} from 'react';
import "./style/About.scss";
import {Query} from "react-apollo";
import ReactHtmlParser from "react-html-parser";

const ABOUT_QUERY = gql`
  {
    siteConfig {
      aboutText
    }
  }
`;

export default class About extends Component {
    render() {
        return (
            <div className="About">
                <header>
                    <Query query={ABOUT_QUERY}>
                        {({loading, data, error}) => {
                            if (loading) return (
                                <div>
                                    <h1>Loading</h1>
                                </div>);
                            if (error) return (
                                <div>
                                    <h1>Error</h1>
                                </div>);

                            return <div>
                                <h1>Since the dawn of time we've been numbero uno</h1>
                                <hr/>
                                {ReactHtmlParser(data.siteConfig.aboutText)}
                            </div>;
                        }}
                    </Query>
                </header>
            </div>
        );
    }
}