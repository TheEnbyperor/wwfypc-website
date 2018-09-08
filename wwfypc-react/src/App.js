import React, {Component} from 'react';
import ApolloClient from "apollo-boost";
import {ApolloProvider, Query} from "react-apollo";
import {BrowserRouter, Route, Switch} from 'react-router-dom';
import gql from 'graphql-tag';

import './App.scss';
import Menu from './Shared/Menu';
import BottomBar from './Shared/BottomBar';
import Home from './Home/Home';
import Service from './Service/Service';
import BuyAndSell from './BuyAndSell/BuyAndSell';

export const BASE_URL = process.env.REACT_APP_BACKEND_HOST || "http://127.0.0.1:8000";

const client = new ApolloClient({
    uri: BASE_URL + "/graphql/"
});

const SERVICES_QUERY = gql`
  query {
    servicePages {
      id
      name
      url
    }
  }
`;

class App extends Component {
    render() {
        return (
            <ApolloProvider client={client}>
                <BrowserRouter>
                    <div className="App">
                        <Menu/>
                        <Switch>
                            <Route exact path="/" component={Home}/>
                            <Route path="/buy-and-sell" component={BuyAndSell}/>
                            <Query query={SERVICES_QUERY}>
                                {({loading, error, data}) => {
                                    if (loading || error) return null;

                                    return data.servicePages.map((page) => {
                                        return <Route path={"/" + page.url} key={page.id}
                                                      render={(props) => <Service {...props} serviceId={page.id} />}/>;
                                    });
                                }}
                            </Query>
                        </Switch>
                        <BottomBar/>
                    </div>
                </BrowserRouter>
            </ApolloProvider>
        );
    }
}

export default App;
