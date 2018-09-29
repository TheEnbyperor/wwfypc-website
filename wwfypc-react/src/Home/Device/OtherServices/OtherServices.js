import React, {Component} from 'react';
import gql from 'graphql-tag';
import {Query} from 'react-apollo';
import {Link} from 'react-router-dom'
import Button from "../../../Shared/Buttons";
import {BASE_URL} from "../../../App";

const OTHER_SERVICES_QUERY = gql`
  query {
    otherServices {
      name
      icon
      description
      buttonText
      colour
      linkTo
    }
  }
`;

export default class OtherServices extends Component {
    render() {
        return (
            <div className="Devices">
                <div>
                    <Query query={OTHER_SERVICES_QUERY}>
                        {({loading, data, error}) => {
                            if (loading) return <h2>Loading</h2>;
                            if (error) return <h2>Error</h2>;

                            return data.otherServices.map(({name, icon, description, buttonText, colour, linkTo}, i) =>
                                <div key={i}>
                                    <img src={BASE_URL + icon} alt=""/>
                                    <h3 className={"colour-" + colour}>{name}</h3>
                                    <p>{description}</p>
                                    <Link to={linkTo}>
                                        <Button colour={colour} small>{buttonText}</Button>
                                    </Link>
                                </div>
                            );
                        }}
                    </Query>
                </div>
                <div className="other">
                    <Button colour={4} onClick={this.props.onSelectBack}>Back</Button>
                </div>
            </div>
        );
    }
}