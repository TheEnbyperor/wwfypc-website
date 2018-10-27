import React, {Component} from "react";
import gql from 'graphql-tag';
import {Query} from 'react-apollo';
import {Link} from 'react-router-dom';
import './style/Filter.scss';

const FILTER_QUERY = gql`
  query {
    buyAndSellCategories {
      id
      name
      colour
    }
  }
`;

export default class Filter extends Component {
    render() {
        return (
            <div className="Filter">
                <Query query={FILTER_QUERY}>
                    {({loading, error, data}) => {
                        if (loading) return null;
                        if (error) return <div className="colour-3">Error</div>;

                        return data.buyAndSellCategories.map((category) => {
                            return (
                                <div key={category.id} className={"colour-" + category.colour}
                                     onClick={() => this.props.onSelect(category.id)}>
                                    {category.name}
                                </div>
                            )
                        })
                    }}
                </Query>
                <Link to="/sell">
                    <div className="colour-4">
                        Sell your item
                    </div>
                </Link>
                <Link to="/build-pc">
                    <div className="colour-5">
                        Build a PC
                    </div>
                </Link>
            </div>
        )
    }
}