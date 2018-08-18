import React, {Component} from 'react';
import ApolloClient from "apollo-boost";
import {ApolloProvider} from "react-apollo";
import {BrowserRouter, Route, Switch} from 'react-router-dom';


import './App.scss';
import Home from './Home/Home';
import BuyAndSell from './BuyAndSell/BuyAndSell';

export const BASE_URL = "http://127.0.0.1:8000";

const client = new ApolloClient({
    uri: BASE_URL + "/graphql/"
});


class App extends Component {
    render() {
        return (
            <ApolloProvider client={client}>
                <BrowserRouter>
                    <div className="App">
                        <Switch>
                            <Route exact path="/" component={Home}/>
                            <Route path="/buy-and-sell" component={BuyAndSell}/>
                        </Switch>
                    </div>
                </BrowserRouter>
            </ApolloProvider>
        );
    }
}

export default App;
