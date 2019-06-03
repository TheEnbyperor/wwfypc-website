'use strict';
import React, {Component} from 'react';
import ApolloClient, {gql} from "apollo-boost";
import {render} from "react-dom";
import {ApolloProvider, Query} from "react-apollo";

const client = new ApolloClient({
    uri: "https://api.cardifftec.uk/graphql/"
});

class DeviceRepair extends Component {
    constructor(props) {
        super(props);
    }

    render() {
        return (
            <ApolloProvider client={client}>
                <div>
                    <div className="category-selection">
                        <div>iPhone</div>
                        <div>iPad</div>
                    </div>
                    <div className="model-selection">
                        <Query
                            query={gql`{
                                    deviceTypes(category: "RGV2aWNlQ2F0ZWdvcnlUeXBlOjE=") {
                                      name
                                      image
                                    }
                                  }`}>
                            {({loading, error, data}) => {
                                if (loading) return <p>Loading...</p>;
                                if (error) return <p>Error :(</p>;

                                return data.deviceTypes.map(d => <div>
                                    <div>
                                        <img src={"https://api.cardifftec.uk" + d.image}/>
                                    </div>
                                    <span>{d.name}</span>
                                </div>)
                            }}
                        </Query>
                        <div>
                            <div>
                                <img src="images/iPhones/4.png"/>
                            </div>
                            <span>iPhone 4</span>
                        </div>
                        <div>
                            <div>
                                <img src="images/iPhones/5C.png"/>
                            </div>
                            <span>iPhone 5C</span>
                        </div>
                        <div>
                            <div>
                                <img src="images/iPhones/6.png"/>
                            </div>
                            <span>iPhone 6</span>
                        </div>
                        <div>
                            <div>
                                <img src="images/iPhones/6+.png"/>
                            </div>
                            <span>iPhone 6+</span>
                        </div>
                        <div>
                            <div>
                                <img src="images/iPhones/6S.png"/>
                            </div>
                            <span>iPhone 6S</span>
                        </div>
                    </div>
                </div>
            </ApolloProvider>
        );
    }
}

let domContainer = document.querySelector('#devicerepair_container');
render(<DeviceRepair/>, domContainer);