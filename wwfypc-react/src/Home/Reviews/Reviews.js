import React, {Component} from 'react';
import {Query} from 'react-apollo';
import gql from 'graphql-tag';
import {BASE_URL} from "../../App";
import "./style/Reviews.scss";

import Star from './img/Star.svg';

const REVIEW_QUERY = gql`
  query {
    siteConfig {
      featuredReview
      featuredReviewName
    }
    sellingPoints {
      title
      text
      image
    }
  }
`;

export default class Reviews extends Component {
    render() {
        return (
            <div className="Reviews">
                <div>
                    <Query query={REVIEW_QUERY}>
                        {({loading, error, data}) => {
                            if (loading) return null;
                            if (error) return <h2>Error</h2>;

                            return [
                                <div key={0} className="bigReview">
                                    <div className="stars">
                                        <img src={Star} alt=""/>
                                        <img src={Star} alt=""/>
                                        <img src={Star} alt=""/>
                                        <img src={Star} alt=""/>
                                        <img src={Star} alt=""/>
                                    </div>
                                    <p dangerouslySetInnerHTML={{__html: data.siteConfig.featuredReview}} />
                                    <p>{data.siteConfig.featuredReviewName}</p>
                                </div>,
                                <div key={1} className="pointers">
                                    {data.sellingPoints.map(({image}, i) =>
                                        <img key={i} src={BASE_URL + image} alt=""/>)}
                                    {data.sellingPoints.map(({title, text}, i) =>
                                        <div key={i}>
                                            <h2 dangerouslySetInnerHTML={{__html: title}} />
                                            <p dangerouslySetInnerHTML={{__html: text}} />
                                        </div>
                                    )}
                                </div>
                            ];
                        }}
                    </Query>
                </div>
            </div>
        );
    }
}