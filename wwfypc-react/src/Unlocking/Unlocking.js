import React, {Component} from 'react';
import gql from 'graphql-tag';
import {Query} from 'react-apollo';
import DocumentTitle from 'react-document-title';
import Footer from "../Shared/Footer/Footer";
import Button from "../Shared/Buttons";
import Indicators from "../Shared/Indicators";
import {addToCart} from "../Cart/Cart";
import {BASE_URL} from "../App";
import Lock from "./img/lock.svg";
import "./style/Unlocking.scss";
import Arrow from "./img/Arrow.svg";

const CONFIG_QUERY = gql`
  query {
    siteConfig {
      unlockingText
    }
  }
`;

const DEVICE_MODELS_QUERY = gql`
  query {
    unlockingDeviceTypes {
      name
      id
    }
  }
`;

const DEVICE_MODEL_QUERY = gql`
  query($id: ID!) {
    unlockingDeviceType(id: $id) {
      name
      image
    }
  }
`;

const DEVICE_NETWORKS_QUERY = gql`
  query {
    unlockingNetworks {
      name
      description
      id
    }
  }
`;

const DEVICE_NETWORK_QUERY = gql`
  query($id: ID!, $device: ID!) {
    unlockingNetwork(id: $id) {
      name
      unlockingTime
    }
    unlockingPrice(network: $id, device: $device) {
      price
      id
    }
  }
`;

class Notice extends Component {
    render() {
        return <div className="Notice">
            <Query query={CONFIG_QUERY}>
                {({loading, data, error}) => {
                    if (loading) return <h2>Loading</h2>;
                    if (error) return <h2>Error</h2>;

                    return [
                        <img key={0} src={Lock} alt=""/>,
                        <div key={1} dangerouslySetInnerHTML={{__html: data.siteConfig.unlockingText}}/>,
                        <Button key={2} colour={3} onClick={this.props.onAccept}>Next</Button>
                    ];
                }}
            </Query>
        </div>
    }
}

class UnlockInfo extends Component {
    constructor(props) {
        super(props);

        this.state = {
            imeiErrors: null,
            inCart: false,
            lastProps: null,
        };

        this.imei = React.createRef();

        this.addToCart = this.addToCart.bind(this);
    }

    static valid_luhn(value) {
        if (/[^0-9-\s]+/.test(value)) return false;

        // The Luhn Algorithm. It's so pretty.
        let nCheck = 0, nDigit = 0, bEven = false;
        value = value.replace(/\D/g, "");

        for (let n = value.length - 1; n >= 0; n--) {
            const cDigit = value.charAt(n);
            nDigit = parseInt(cDigit, 10);

            if (bEven) {
                if ((nDigit *= 2) > 9) nDigit -= 9;
            }

            nCheck += nDigit;
            bEven = !bEven;
        }

        return (nCheck % 10) === 0;
    }

    addToCart(id) {
        const imei = this.imei.current.value.trim();
        if (imei.length !== 15 || !UnlockInfo.valid_luhn(imei)) {
            this.setState({
                imeiErrors: <p>Invalid IMEI</p>
            })
        } else {
            this.setState({
                imeiErrors: null,
                inCart: true,
            });
            addToCart("unlocking", id + ";" + imei);
        }
    }

    static getDerivedStateFromProps(props, state) {
        if (JSON.stringify(props) !== state.lastProps) {
            return {
                imeiErrors: null,
                inCart: false,
                lastProps: JSON.stringify(props),
            }
        } else {
            return null;
        }
    }

    render() {
        return <div className="Info">
            <div>
                {this.props.selectedModel === null ?
                    [
                        <img key={0} src={Lock} alt=""/>,
                        <h2 key={1}>Please select your device</h2>
                    ] : <Query query={DEVICE_MODEL_QUERY} variables={{id: this.props.selectedModel}}>
                        {({loading, data, error}) => {
                            if (loading) return <h2>Loading</h2>;
                            if (error) return <h2>Error</h2>;

                            return [
                                <img key={0} src={BASE_URL + data.unlockingDeviceType.image} alt=""/>,
                                <h2 key={1}>{data.unlockingDeviceType.name}</h2>,
                                this.props.selectedNetwork === null ? null :
                                    <Query key={2} query={DEVICE_NETWORK_QUERY}
                                           variables={{
                                               id: this.props.selectedNetwork,
                                               device: this.props.selectedModel
                                           }}>
                                        {({loading, data, error}) => {
                                            if (loading) return <div className="info">
                                                <ul>
                                                    <li>Loading</li>
                                                </ul>
                                            </div>;
                                            if (error) return <div className="info">
                                                <ul>
                                                    <li>Error</li>
                                                </ul>
                                            </div>;

                                            return [
                                                <div key={0} className="info">
                                                    <ul>
                                                        <li>{data.unlockingNetwork.name}</li>
                                                        <li>{data.unlockingNetwork.unlockingTime}</li>
                                                    </ul>
                                                </div>,
                                                <div key={1} className="price">
                                                    &pound;{data.unlockingPrice.price}
                                                    <span>(inc. VAT)</span>
                                                </div>,
                                                <div key={2} className="input">
                                                    {this.state.imeiErrors}
                                                    <input type="text" placeholder="IMEI" ref={this.imei}/>
                                                    <p>
                                                        You can find your IMEI by dialing <span>*#06#</span>
                                                        &nbsp;on your phone.
                                                    </p>
                                                </div>,
                                                !this.state.inCart ?
                                                    <Button key={3} colour={2}
                                                            onClick={() => this.addToCart(data.unlockingPrice.id)}>
                                                        Add to cart
                                                    </Button>
                                                    :
                                                    <Button key={3} colour={3}>
                                                        Added to cart
                                                    </Button>
                                            ];
                                        }}
                                    </Query>
                            ];
                        }}
                    </Query>
                }
            </div>
        </div>;
    }
}

class DeviceModels extends Component {
    render() {
        return <Query query={DEVICE_MODELS_QUERY}>
            {({loading, data, error}) => {
                if (loading) return <h2>Loading</h2>;
                if (error) return <h2>Error</h2>;

                return data.unlockingDeviceTypes.map(({id, name}, i) =>
                    <div className={"model" + ((this.props.selectedModel === id) ? " selected" : "")}
                         key={i} onClick={() => this.props.onSelect(id)}>
                        <span>{name}</span>
                    </div>
                );
            }}
        </Query>
    }
}

class Networks extends Component {
    render() {
        return <Query query={DEVICE_NETWORKS_QUERY}>
            {({loading, data, error}) => {
                if (loading) return <h2>Loading</h2>;
                if (error) return <h2>Error</h2>;

                return data.unlockingNetworks.map(({id, name, description}, i) =>
                    <div className={"repairType" + ((this.props.selectedNetwork === id) ? " selected open" : "")}
                         key={i} onClick={() => this.props.onSelect(id)}>
                        <div className="top">
                            <span>{name}</span>
                            <img src={Arrow} alt=""/>
                        </div>
                        <p dangerouslySetInnerHTML={{__html: description}}/>
                    </div>
                )
                    ;
            }}
        </Query>
    }
}

class Device extends Component {
    constructor(props) {
        super(props);

        this.state = {
            selectedModel: null,
            selectedNetwork: null,
        };

        this.selectModel = this.selectModel.bind(this);
        this.selectNetwork = this.selectNetwork.bind(this);
    }

    selectModel(model) {
        if (model !== this.state.selectedModel) {
            this.setState({
                selectedModel: model,
                selectedNetwork: null,
            });
        } else {
            this.setState({
                selectedModel: null,
                selectedNetwork: null,
            });
        }
    }

    selectNetwork(network) {
        if (network !== this.state.selectedNetwork) {
            this.setState({
                selectedNetwork: network,
            })
        } else {
            this.setState({
                selectedNetwork: null,
            })
        }
    }

    render() {
        let stage = 1;
        if (this.state.selectedModel !== null) {
            stage = 2;
        }
        if (this.state.selectedNetwork !== null) {
            stage = 3;
        }

        return <div className="UnlockingDevice">
            <Indicators steps={3} step={stage}/>
            <div className="RepairSelection">
                <div className={"stage-" + stage}>
                    <div className="Select">
                        <DeviceModels onSelect={this.selectModel} selectedModel={this.state.selectedModel}/>
                        <Networks onSelect={this.selectNetwork} selectedNetwork={this.state.selectedNetwork}/>
                    </div>
                    <UnlockInfo selectedModel={this.state.selectedModel} selectedNetwork={this.state.selectedNetwork}/>
                </div>
            </div>
        </div>
    }
}

export default class Unlocking extends Component {
    constructor(props) {
        super(props);

        this.state = {
            termsAccepted: false,
        };

        this.acceptTerms = this.acceptTerms.bind(this);
    }

    componentDidMount() {
        new window.fullpage(".Unlocking", {
            anchors: ["unlocking", "footer"],
            navigationTooltips: ["Unlocking", "Footer"],
            navigationPosition: 'right',
            navigation: true,
            licenseKey: "OPEN-SOURCE-GPLV3-LICENSE",
            paddingTop: "60px",
            paddingBottom: "0",
            scrollOverflow: true,
        })
    }

    componentWillUnmount() {
        window.fullpage_api.destroy();
    }

    acceptTerms() {
        this.setState({
            termsAccepted: true,
        })
    }

    render() {
        return <DocumentTitle title="Unlocking | We Will Fix Your PC">
            <div className="Unlocking">
                <div className="section">
                    <div className="UnlockingInner">
                        <h1>Phone Unlocking</h1>
                        {!this.state.termsAccepted ?
                            <Notice onAccept={this.acceptTerms}/> :
                            <Device/>}
                    </div>
                </div>
                <div className="section fp-auto-height"><Footer/></div>
            </div>
        </DocumentTitle>;
    }
}