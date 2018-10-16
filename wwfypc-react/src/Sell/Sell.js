import React, {Component} from 'react';
import gql from 'graphql-tag';
import {Query} from 'react-apollo';
import Footer from "../Shared/Footer/Footer";
import Button from "../Shared/Buttons";
import {BASE_URL} from "../App";
import "./style/Sell.scss";

const DEVICE_CATEGORIES_QUERY = gql`
    query {
      sellingDeviceCategories {
        name
        id
        icon
      }
    }
`;

const DEVICE_MODELS_QUERY = gql`
  query($category: ID!) {
    sellingDeviceModels(category: $category) {
      name
      id
    }
  }
`;

const DEVICE_MODEL_QUERY = gql`
  query($id: ID!) {
    sellingDeviceModel(id: $id) {
      name
      devicePermutations {
        id
        values {
          id
          displayName
        }
      }
    }
  }
`;

const DEVICE_PRICE_QUERY = gql`
  query($id: ID!, $permutations: [ID!]!) {
    sellingDeviceModel(id: $id) {
      priceEstimate(permutations: $permutations) {
        price
      }
    }
  }
`;

const DEVICE_PERMUTATIONS_QUERY = gql`
  query($id: ID!) {
    sellingDeviceModel(id: $id) {
      devicePermutations {
        id
        name
        values {
          id
          value
        }
      } 
    }
  }
`;

class SellForm extends Component {
    constructor(props) {
        super(props);

        this.state = {
            selectedCategory: null,
            selectedModel: null,
            selectedPermutations: {}
        };

        this.selectCategory = this.selectCategory.bind(this);
        this.selectModel = this.selectModel.bind(this);
        this.selectPermutation = this.selectPermutation.bind(this);
    }

    selectCategory(event) {
        this.setState({
            selectedCategory: event.target.value === "null" ? null : event.target.value,
        })
    }

    selectModel(event) {
        this.setState({
            selectedModel: event.target.value === "null" ? null : event.target.value,
        })
    }

    selectPermutation(id, event) {
        const selectedPremutations = this.state.selectedPermutations;
        selectedPremutations[id] = event.target.value === "null" ? null : event.target.value;

        this.setState({
            selectedPermutations: selectedPremutations,
        })
    }

    render() {
        return <Query query={DEVICE_CATEGORIES_QUERY}>
            {({loading, data, error}) => {
                let category;
                if (loading || error) {
                    category = undefined;
                } else {
                    category = data.sellingDeviceCategories.find(elm => elm.id === this.state.selectedCategory);
                }

                return <div className="inner">
                    <div className="left">
                        <h1>Selling your tech</h1>
                        <h2>We buy your unwanted tech for cash</h2>
                        <p>Fill in this form for an estimate, then bring in your device at your nearest convenience</p>
                        <hr/>
                        {loading ? null :
                            error ? <h2>Error</h2> :
                                <div className="SellForm">
                                    <div className="select">
                                        <p>Device</p>
                                        <div className="inner">
                                            <select onChange={this.selectCategory}>
                                                <option value="null">---</option>
                                                {data.sellingDeviceCategories.map(({name, id}) =>
                                                    <option value={id}>{name}</option>)}
                                            </select>
                                        </div>
                                    </div>
                                    {this.state.selectedCategory === null ? null : [
                                        <Query key={0} query={DEVICE_MODELS_QUERY} variables={{
                                            category: this.state.selectedCategory
                                        }}>
                                            {({loading, data, error}) => {
                                                if (loading) return null;
                                                if (error) return <h2>Error</h2>;

                                                return <div className="select">
                                                    <p>Model</p>
                                                    <div className="inner">
                                                        <select onChange={this.selectModel}>
                                                            <option value="null">---</option>
                                                            {data.sellingDeviceModels.map(({name, id}, i) =>
                                                                <option value={id} key={i}>{name}</option>)}
                                                        </select>
                                                    </div>
                                                </div>
                                            }}
                                        </Query>,
                                        this.state.selectedModel === null ? null :
                                            <Query key={1} query={DEVICE_PERMUTATIONS_QUERY} variables={{
                                                id: this.state.selectedModel
                                            }}>
                                                {({loading, data, error}) => {
                                                    if (loading) return null;
                                                    if (error) return <h2>Error</h2>;

                                                    return data.sellingDeviceModel.devicePermutations.map(({id, name, values}, i) =>
                                                        <div className="select" key={i}>
                                                            <p>{name}</p>
                                                            <div className="inner">
                                                                <select onChange={(evt) =>
                                                                    this.selectPermutation(id, evt)}>
                                                                    <option value="null">---</option>
                                                                    {values.map(({id, value}, i) =>
                                                                        <option value={id} key={i}>{value}</option>)}
                                                                </select>
                                                            </div>
                                                        </div>
                                                    )
                                                }}
                                            </Query>
                                    ]
                                    }
                                </div>
                        }
                    </div>
                    <div className="right">
                        {typeof category === "undefined" ? null : [
                            <img key={0} src={BASE_URL + category.icon} alt=""/>,
                            this.state.selectedModel === null ?
                                <ul key={1}>
                                    <li>{category.name}</li>
                                </ul>
                                : <Query key={1} query={DEVICE_MODEL_QUERY} variables={{
                                    id: this.state.selectedModel
                                }}>
                                    {({loading, data, error}) => {
                                        if (loading) return (
                                            <ul>
                                                <li>{category.name}</li>
                                            </ul>
                                        );
                                        if (error) return <h2>Error</h2>;

                                        let everyPermutationSelected = true;
                                        const queryPermutations = [];
                                        const permutations = data.sellingDeviceModel.devicePermutations
                                            .map((permutation, i) => {
                                                const selectedPermutation = Object.keys(this.state.selectedPermutations)
                                                    .find(elm => elm === permutation.id);
                                                if (typeof permutation !== "undefined") {
                                                    const value = this.state.selectedPermutations[selectedPermutation];
                                                    const displayValue = permutation.values
                                                        .find(elm => elm.id === value);
                                                    if (typeof displayValue !== "undefined") {
                                                        queryPermutations.push(value);
                                                        return <li key={i}>{displayValue.displayName}</li>;
                                                    }
                                                }
                                                everyPermutationSelected = false;
                                                return null;
                                            });

                                        return [
                                            <ul key={0}>
                                                <li>{data.sellingDeviceModel.name}</li>
                                                {permutations}
                                            </ul>,
                                            !everyPermutationSelected ? null :
                                                <Query key={1} query={DEVICE_PRICE_QUERY} variables={{
                                                    id: this.state.selectedModel,
                                                    permutations: queryPermutations,
                                                }}>
                                                    {({loading, data, error}) => {
                                                        if (loading) return null;
                                                        if (error) return <h2>Error</h2>;
                                                        return <div className="price">
                                                            Your estimate is
                                                            <span className="price">
                                                                &pound;{data.sellingDeviceModel.priceEstimate.price}
                                                            </span>
                                                            <Button colour={6}>
                                                                Print estimate
                                                            </Button>
                                                            <span className="disclaimer">
                                                                Estimates are subject to change upon device inspection
                                                            </span>
                                                        </div>
                                                    }}
                                                </Query>
                                        ]
                                    }}
                                </Query>
                        ]}
                    </div>
                </div>;
            }}
        </Query>
    }
}

export default class Sell extends Component {
    componentDidMount() {
        new window.fullpage(".Sell", {
            anchors: ["sell", "footer"],
            navigationTooltips: ["Sell", "Footer"],
            navigationPosition: 'right',
            navigation: true,
            licenseKey: "OPEN-SOURCE-GPLV3-LICENSE",
        })
    }

    componentWillUnmount() {
        window.fullpage_api.destroy();
    }

    render() {
        return <div className="Sell">
            <div className="section SellInner">
                <SellForm/>
            </div>
            <div className="section fp-auto-height" style={{
                paddingBottom: 70,
            }}><Footer/></div>
        </div>;
    }
}