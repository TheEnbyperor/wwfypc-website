import React, {Component} from "react";
import gql from 'graphql-tag';
import {Query} from 'react-apollo';
import Footer from "../Shared/Footer/Footer";
import Button from '../Shared/Buttons';
import {BASE_URL} from "../App";
import {addToCart} from "../Cart/Cart";
import './style/BuildPc.scss';
import DocumentTitle from "react-document-title";

const BASE_MODELS_QUERY = gql`
  query {
    basePcModels {
      id
      name
      description
      priceRange
      image
    }
  }
`;

const CUSTOMISATION_QUERY = gql`
  query($id: ID!) {
    basePcModel(id: $id) {
      name
      id
      image
      description
      customisations {
        id
        helpText
        options {
          name
          additionalCost
          id
        }
      } 
    }
  }
`;

const PRICE_QUERY = gql`
  query($basePc: ID!, $options: [ID!]!) {
    pcPrice(basePc: $basePc, options: $options) {
      id
      price
    }
  }
`;

class Models extends Component {
    render() {
        return <div className="BuildModel">
            <header>
                <h1>Build a custom PC</h1>
                <h2>Made to spec, budget & order</h2>
            </header>
            <Query query={BASE_MODELS_QUERY}>
                {({loading, error, data}) => {
                    if (loading) return <header>
                        <h2>Loading</h2>
                    </header>;
                    if (error) return <header>
                        <h2>Error</h2>
                    </header>;

                    setTimeout(window.$.scrollify.update, 500);

                    return [
                        <header key={0}>
                            <div className="Images">
                                {data.basePcModels.map(({image}, i) => <img src={BASE_URL + image} alt="" key={i}/>)}
                            </div>
                        </header>,
                        <section key={1}>
                            <div className="Info">
                                {data.basePcModels.map(({name, priceRange, description, id}, i) =>
                                    <div key={i}>
                                        <h2>{name}</h2>
                                        <h3>{priceRange}</h3>
                                        <p dangerouslySetInnerHTML={{__html: description}}/>
                                        <Button colour={(i + 1) % 4} onClick={() => this.props.onSelect(id)}>
                                            Customize
                                        </Button>
                                    </div>
                                )}
                            </div>
                        </section>
                    ]
                }}
            </Query>
        </div>;
    }
}

class Customise extends Component {
    constructor(props) {
        super(props);

        this.state = {
            options: {},
            inCart: false,
        };

        this.onOptionSelect = this.onOptionSelect.bind(this);
        this.addToCart = this.addToCart.bind(this);
    }

    onOptionSelect(id, evt) {
        const options = this.state.options;
        options[id] = evt.target.value === "null" ? null : evt.target.value;
        console.log(options);
        this.setState({
            options: options,
        })
    }

    addToCart(id) {
        this.setState({
            inCart: true
        });
        addToCart("build_pc", id);
    }

    render() {
        return <div className="BuildCustomise">
            <header>
                <h1>Customise your PC</h1>
            </header>
            <section>
                <Query query={CUSTOMISATION_QUERY} variables={{id: this.props.model}}>
                    {({loading, data, error}) => {
                        if (loading) return <h2>Loading</h2>;
                        if (error) return <h2>Error</h2>;

                        let customisations = [];
                        data.basePcModel.customisations.forEach(option => {
                            const selectedCustomisation = Object.keys(this.state.options)
                                .find(elm => elm === option.id);
                            console.log(selectedCustomisation);
                            if (typeof selectedCustomisation === "undefined" && selectedCustomisation !== null) {
                                if (typeof option.options[0] !== "undefined") {
                                    customisations.push(option.options[0].id);
                                }
                            } else {
                                customisations.push(this.state.options[selectedCustomisation]);
                            }
                        });

                        return <div className="Customise">
                            <div className="back">
                                <i className="fas fa-chevron-left" onClick={this.props.onBack}/>
                            </div>
                            <div className="img">
                                <img src={BASE_URL + data.basePcModel.image} alt=""/>
                            </div>
                            <div>
                                <h2>{data.basePcModel.name}</h2>
                                <p dangerouslySetInnerHTML={{__html: data.basePcModel.description}}/>
                                <form>
                                    {data.basePcModel.customisations.map(({id, helpText, options}, i) =>
                                        <div className="select" key={i}>
                                            <div className="inner">
                                                <select value={this.state.options[id]}
                                                        onChange={evt => this.onOptionSelect(id, evt)}>
                                                    {options.map(({id, name, additionalCost}, i) => {
                                                        let extra = "";
                                                        if (additionalCost > 0) {
                                                            extra = " (+£" + additionalCost.toFixed(2) + ")";
                                                        }
                                                        return <option value={id} key={i}>{name + extra}</option>;
                                                    })}
                                                </select>
                                            </div>
                                            <div className="info">
                                                <i className="fas fa-question-circle"/>
                                                <div dangerouslySetInnerHTML={{__html: helpText}}/>
                                            </div>
                                        </div>
                                    )}
                                </form>
                                <div className="price">
                                    <Query query={PRICE_QUERY} variables={{
                                        basePc: this.props.model,
                                        options: customisations,
                                    }}>
                                        {({loading, data, error}) => {
                                            if (loading) return <Button colour={2}>Loading</Button>;
                                            if (error) return <Button colour={1}>Error</Button>;

                                            return [
                                                <Button key={0} colour={4}>&pound;{data.pcPrice.price}</Button>,
                                                !this.state.inCart ?
                                                    <Button key={1} colour={3} onClick={() =>
                                                        this.addToCart(data.pcPrice.id)}>
                                                        Add to cart
                                                    </Button>
                                                    :
                                                    <Button key={1} colour={3}>
                                                        Added to cart
                                                    </Button>
                                            ];
                                        }}
                                    </Query>
                                </div>
                            </div>
                        </div>
                    }}
                </Query>
            </section>
        </div>;
    }
}

export default class BuildPc extends Component {
    constructor(props) {
        super(props);

        this.state = {
            selectedModel: null,
        };

        this.selectModel = this.selectModel.bind(this);
    }

    componentDidMount() {
        window.$.scrollify({
            section: ".section",
            sectionName : "anchor",
            interstitialSection: ".fp-auto-height",
        })
    }

    componentWillUnmount() {
        window.$.scrollify.destroy();
    }


    selectModel(model) {
        this.setState({
            selectedModel: model,
        })
    }

    render() {
        return <DocumentTitle title="Build a PC | We Will Fix Your PC">
            <div className="BuildPc">
                <div className="section" data-anchor="build-pc">
                    <div className="BuildPcInner">
                        {this.state.selectedModel === null ?
                            <Models onSelect={this.selectModel}/> :
                            <Customise model={this.state.selectedModel} onBack={() => this.selectModel(null)}/>
                        }
                    </div>
                </div>
                <div className="section fp-auto-height" data-anchor="footer"><Footer/></div>
            </div>
        </DocumentTitle>;
    }
}