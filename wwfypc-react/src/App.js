import React, {Component} from 'react';
import ApolloClient from "apollo-boost";
import {ApolloProvider, Query} from "react-apollo";
import {BrowserRouter, Route, Switch} from 'react-router-dom';
import DocumentTitle from 'react-document-title';
import gql from 'graphql-tag';
import $ from 'jquery';
import 'jquery-scrollify';

import './App.scss';
import Menu from './Shared/Menu';
import Home from './Home/Home';
import Service from './Service/Service';
import BuyAndSell from './BuyAndSell/BuyAndSell';
import Cart from './Cart/Cart';
import Contact from './Contact/Contact';
import Sell from './Sell/Sell';
import Unlocking from './Unlocking/Unlocking';
import BuildPc from './BuildPc/BuildPc';

window.$ = $;

export const BASE_URL = process.env.REACT_APP_BACKEND_HOST || "http://192.168.1.2:8000";
export const WORLDPAY_KEY = "T_C_52bc5b16-562d-4198-95d4-00b91f30fe2c";

export const client = new ApolloClient({
    uri: BASE_URL + "/graphql/",
});

const SERVICES_QUERY = gql`
  query {
    servicePages {
      id
      url
    }
  }
`;

class App extends Component {
    render() {
        return (
            <ApolloProvider client={client}>
                <DocumentTitle title="We Will Fix Your PC">
                    <BrowserRouter>
                        <div className="App">
                            <Menu/>
                            <Switch>
                                <Route exact path="/" component={Home}/>
                                <Route path="/buy-and-sell" component={BuyAndSell}/>
                                <Route path="/sell" component={Sell}/>
                                <Route path="/cart" component={Cart}/>
                                <Route path="/contact" component={Contact}/>
                                <Route path="/unlocking" component={Unlocking}/>
                                <Route path="/build-pc" component={BuildPc}/>
                                <Query query={SERVICES_QUERY}>
                                    {({loading, error, data}) => {
                                        if (loading || error) return null;

                                        return data.servicePages.map((page) => {
                                            return <Route path={"/" + page.url} key={page.id}
                                                          render={(props) => <Service {...props}
                                                                                      serviceId={page.id}/>}/>;
                                        });
                                    }}
                                </Query>
                            </Switch>
                        </div>
                    </BrowserRouter>
                </DocumentTitle>
            </ApolloProvider>
        );
    }
}

export default App;
