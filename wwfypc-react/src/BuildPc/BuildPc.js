import React, {Component} from "react";
import gql from 'graphql-tag';
import {Query} from 'react-apollo';
import Footer from "../Shared/Footer/Footer";
import Button from '../Shared/Buttons';
import {BASE_URL} from "../App";
import {addToCart} from "../Cart/Cart";
import './style/BuildPc.scss';

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
                                        <p>
                                            {description}
                                        </p>
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
            options: {}
        };

        this.onOptionSelect = this.onOptionSelect.bind(this);
    }

    onOptionSelect(id, evt) {
        const options = this.state.options;
        options[id] = evt.target.value === "null" ? null : evt.target.value;
        this.setState({
            options: options,
        })
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

                        let everyCustomisationSelected = true;
                        data.basePcModel.customisations.forEach(option => {
                            const selectedCustomisation = Object.keys(this.state.options)
                                    .find(elm => elm === option.id);
                            if (typeof selectedCustomisation === "undefined" && selectedCustomisation !== null) {
                                everyCustomisationSelected = false;
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
                                <p>
                                    {data.basePcModel.description}
                                </p>
                                <form>
                                    {data.basePcModel.customisations.map(({id, helpText, options}, i) =>
                                        <div className="select" key={i}>
                                            <div className="inner">
                                                <select value={this.state.options[id]}
                                                        onChange={evt => this.onOptionSelect(id, evt)}>
                                                    <option value="null">---</option>
                                                    {options.map(({id, name}, i) =>
                                                        <option value={id} key={i}>{name}</option>
                                                    )}
                                                </select>
                                            </div>
                                            <div className="info">
                                                <i className="fas fa-question-circle"/>
                                                <p>{helpText}</p>
                                            </div>
                                        </div>
                                    )}
                                </form>
                                <div className="price">
                                    {!everyCustomisationSelected ? null :
                                        <Query query={PRICE_QUERY} variables={{
                                            basePc: this.props.model,
                                            options: Object.keys(this.state.options).map(elm => this.state.options[elm])
                                        }}>
                                            {({loading, data, error}) => {
                                                if (loading) return <Button colour={2}>Loading</Button>;
                                                if (error) return <Button colour={1}>Error</Button>;

                                                return [
                                                    <Button key={0} colour={4}>&pound;{data.pcPrice.price}</Button>,
                                                    <Button key={1} colour={3} onClick={() => {
                                                        addToCart("build_pc", data.pcPrice.id)
                                                    }}>
                                                        Add to cart
                                                    </Button>
                                                ];
                                            }}
                                        </Query>
                                    }
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
        new window.fullpage(".BuildPc", {
            anchors: ["build-pc", "footer"],
            navigationTooltips: ["Build a PC", "Footer"],
            navigationPosition: 'right',
            navigation: true,
            licenseKey: "OPEN-SOURCE-GPLV3-LICENSE",
            paddingBottom: "70px",
        })
    }

    componentWillUnmount() {
        window.fullpage_api.destroy();
    }

    selectModel(model) {
        this.setState({
            selectedModel: model,
        })
    }

    render() {
        return <div className="BuildPc">
            <div className="section">
                <div className="BuildPcInner">
                    {this.state.selectedModel === null ?
                        <Models onSelect={this.selectModel}/> :
                        <Customise model={this.state.selectedModel} onBack={() => this.selectModel(null)}/>
                    }
                </div>
            </div>
            <div className="section fp-auto-height"><Footer/></div>
        </div>;
    }
}