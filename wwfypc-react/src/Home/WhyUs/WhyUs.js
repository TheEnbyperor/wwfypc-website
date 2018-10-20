import React, {Component} from 'react';
import {Query} from 'react-apollo';
import gql from 'graphql-tag';
import "./style/WhyUs.scss";

const WHY_US_QUERY = gql`
  query {
    siteConfig {
      whyChooseUs
    }
  }
`;

export default class WhyUs extends Component {
    render() {
        return (
            <div className="WhyUs">
                <div>
                    <h1>Why choose us?</h1>
                    <Query query={WHY_US_QUERY}>
                        {({loading, error, data}) => {
                            if (loading) return null;
                            if (error) return <p>Error</p>;

                            return <p dangerouslySetInnerHTML={{__html: data.siteConfig.whyChooseUs}} />;
                        }}
                    </Query>
                </div>
            </div>
        );
    }
}