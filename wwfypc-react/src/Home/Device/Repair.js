import React, {Component} from 'react';
import {Query} from "react-apollo";
import gql from "graphql-tag";
import "./style/Repair.scss";
import Button from '../../Shared/Buttons';
import {BASE_URL} from "../../App";
import Arrow from './img/Arrow.svg';

const REPAIR_MODELS_QUERY = gql`
  query ($category: ID!) {
    deviceTypes(category: $category) {
      id
      name
    }
  }
`;

const REPAIR_TYPES_QUERY = gql`
  query ($deviceType: ID!) {
    repairTypes(deviceType: $deviceType) {
      id
      name
      description
    }
  }
`;

const CATEGORY_INFO_QUERY = gql`
  query ($deviceCategory: ID!) {
    deviceCategory(id: $deviceCategory) {
      name
      icon
    }
  }
`;

const DEVICE_INFO_QUERY = gql`
  query ($deviceType: ID!) {
    deviceType(id: $deviceType) {
      name
    }
  }
`;

const REPAIR_INFO_QUERY = gql`
  query ($repairType: ID!) {
    repairType(id: $repairType) {
      name
      repairTime
      price
    }
  }
`;

const DEVICES_QUERY = gql`
  {
    deviceCategories {
      id
      name
      colour
    }
  }
`;

class RepairModels extends Component {
    render() {
        return (
            <Query query={REPAIR_MODELS_QUERY} variables={{category: this.props.category}}>
                {({loading, error, data}) => {
                    if (loading) return <h2>Loading</h2>;
                    if (error) return <h2>Error</h2>;

                    return data.deviceTypes.map(({id, name}) => (
                        <div className={"model" + ((this.props.selectedModel === id) ? " selected" : "")} key={id}
                             onClick={() => this.props.selectModel(id)}>
                            <span>{name}</span>
                        </div>
                    ));
                }}
            </Query>
        )
    }
}

class RepairTypes extends Component {
    render() {
        if (this.props.deviceType !== null) {
            return (
                <Query query={REPAIR_TYPES_QUERY} variables={{deviceType: this.props.deviceType}}>
                    {({loading, error, data}) => {
                        if (loading) return <h2>Loading</h2>;
                        if (error) return <h2>Error</h2>;

                        return data.repairTypes.map(({id, name, description}) => (
                            <div className={"repairType" + ((this.props.selectedRepair === id) ? " selected" : "") +
                            ((this.props.selectedRepairDetail === id) ? " open" : "")} key={id}
                                 onClick={() => this.props.selectRepair(id)}>
                                <div className="top">
                                    <span>{name}</span>
                                    <img src={Arrow} alt="" onClick={() => this.props.openRepairDetail(id)}/>
                                </div>
                                <p dangerouslySetInnerHTML={{__html: description}} />
                            </div>
                        ));
                    }}
                </Query>
            )
        } else {
            return null;
        }
    }
}

class DeliveryTypes extends Component {
    render() {
        if (this.props.repairType !== null) {
            return this.props.deliveryTypes.map(({id, name, description}) => (
                <div className={"deliveryType" + ((this.props.selectedDelivery === id) ? " selected" : "") +
                ((this.props.selectedDeliveryDetail === id) ? " open" : "")} key={id}
                     onClick={() => this.props.selectDelivery(id)}>
                    <div className="top">
                        <span>{name}</span>
                        <img src={Arrow} alt="" onClick={() => this.props.openDeliveryDetail(id)}/>
                    </div>
                    <p dangerouslySetInnerHTML={{__html: description}} />
                </div>
            ));
        } else {
            return null;
        }
    }
}

class RepairInfo extends Component {
    render() {
        return (
            <div className="Info">
                <div>
                    <Query query={CATEGORY_INFO_QUERY} variables={{
                        deviceCategory: this.props.deviceCategory
                    }}>
                        {({loading, error, data}) => {
                            if (loading) return <h2>Loading</h2>;
                            if (error) return <h2>Error</h2>;

                            return [
                                <img key={0} src={BASE_URL + data.deviceCategory.icon} alt={data.deviceCategory.name}/>,
                                this.props.deviceType === null ? <h2 key={1}>{data.deviceCategory.name}</h2> :
                                    <Query key={1} query={DEVICE_INFO_QUERY} variables={{
                                        deviceType: this.props.deviceType
                                    }}>
                                        {({loading, data, error}) => {
                                            if (loading) return <h2>Loading</h2>;
                                            if (error) return <h2>Error</h2>;

                                            return [
                                                <h2 key={0}>{data.deviceType.name}</h2>,
                                                this.props.repairType === null ? null :
                                                    <Query key={1} query={REPAIR_INFO_QUERY} variables={{
                                                        repairType: this.props.repairType
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

                                                            const deliveryType = this.props.deliveryTypes.find(
                                                                type => type.id === this.props.deliveryType);

                                                            return [
                                                                <div key={0} className="info">
                                                                    <ul>
                                                                        <li>{data.repairType.name}</li>
                                                                        <li>{data.repairType.repairTime}</li>
                                                                        {this.props.deliveryType === null ? null :
                                                                            <li>{deliveryType.name}</li>
                                                                        }
                                                                    </ul>
                                                                </div>,
                                                                <div key={1} className="price">
                                                                    &pound;{data.repairType.price}
                                                                </div>,
                                                                this.props.deliveryType === null ? null :
                                                                    <Button key={2} colour={2}
                                                                            onClick={this.props.nextStep}>
                                                                        Fix your device now
                                                                    </Button>
                                                            ];
                                                        }}
                                                    </Query>
                                            ];
                                        }}
                                    </Query>
                            ]
                        }}
                    </Query>
                </div>
            </div>
        )
    }
}

export default class RepairSelection extends Component {
    constructor(props) {
        super(props);

        this.state = {
            selectedModel: null,
            selectedRepair: null,
            selectedRepairDetail: null,
            selectedDelivery: null,
            selectedDeliveryDetail: null,
        };

        this.goBack = this.goBack.bind(this);
        this.selectModel = this.selectModel.bind(this);
        this.selectRepair = this.selectRepair.bind(this);
        this.selectDelivery = this.selectDelivery.bind(this);
        this.openRepairDetail = this.openRepairDetail.bind(this);
        this.openDeliveryDetail = this.openDeliveryDetail.bind(this);
        this.nextStep = this.nextStep.bind(this);
    }

    goBack() {
        if (this.state.selectedRepair === null) {
            this.props.goBack();
        } else {
            this.setState({
                selectedRepair: null,
                selectedDelivery: null,
            });
        }
    }

    selectModel(model) {
        if (model !== this.state.selectedModel) {
            this.setState({
                selectedModel: model,
                selectedRepair: null,
                selectedDelivery: null,
            });
        } else {
            this.setState({
                selectedModel: null,
                selectedRepair: null,
                selectedDelivery: null,
            });
        }
    }

    selectRepair(repair) {
        if (repair !== this.state.selectedRepair) {
            this.setState({
                selectedRepair: repair,
                selectedDelivery: null,
            })
        } else {
            this.setState({
                selectedRepair: null,
                selectedDelivery: null,
            })
        }
    }

    selectDelivery(delivery) {
        if (delivery !== this.state.selectedDelivery) {
            this.setState({
                selectedDelivery: delivery
            })
        }
    }

    openRepairDetail(repair) {
        if (this.state.selectedRepairDetail === repair) {
            this.setState({
                selectedRepairDetail: null
            })
        } else {
            this.setState({
                selectedRepairDetail: repair
            })
        }
    }

    openDeliveryDetail(delivery) {
        if (this.state.selectedDeliveryDetail === delivery) {
            this.setState({
                selectedDeliveryDetail: null
            })
        } else {
            this.setState({
                selectedDeliveryDetail: delivery
            })
        }
    }

    nextStep() {
        this.props.nextStep(this.state.selectedModel, this.state.selectedRepair, this.state.selectedDelivery);
    }

    render() {
        let stage = 1;
        if (this.state.selectedModel !== null) {
            stage = 2;
        }
        if (this.state.selectedRepair !== null) {
            stage = 3;
        }
        if (this.state.selectedDelivery !== null) {
            stage = 4;
        }

        return (
            <div className="RepairSelection">
                <div className={"stage-" + stage}>
                    <div className="Select ">
                        <RepairModels category={this.props.deviceCategory}
                                      selectedModel={this.state.selectedModel}
                                      selectModel={this.selectModel}/>
                        <RepairTypes deviceType={this.state.selectedModel}
                                     selectedRepair={this.state.selectedRepair}
                                     selectedRepairDetail={this.state.selectedRepairDetail}
                                     selectRepair={this.selectRepair}
                                     openRepairDetail={this.openRepairDetail}/>
                        <DeliveryTypes repairType={this.state.selectedRepair}
                                       selectedDeliveryDetail={this.state.selectedDeliveryDetail}
                                       selectedDelivery={this.state.selectedDelivery}
                                       selectDelivery={this.selectDelivery}
                                       deliveryTypes={this.props.devileryTypes}
                                       openDeliveryDetail={this.openDeliveryDetail}/>
                    </div>
                    <RepairInfo deviceCategory={this.props.deviceCategory}
                                deviceType={this.state.selectedModel} repairType={this.state.selectedRepair}
                                deliveryType={this.state.selectedDelivery} nextStep={this.nextStep}
                                deliveryTypes={this.props.devileryTypes}/>
                </div>
                <div className="other">
                    <Button colour={4} onClick={this.props.onSelectBack}>Back</Button>
                    <Query query={DEVICES_QUERY}>
                        {({loading, data, error}) => {
                            if (loading) return null;
                            if (error) return <Button colour={3}>Error</Button>;

                            return data.deviceCategories.slice().reverse().map(({id, name, colour}, i) => {
                                return <Button colour={colour} key={i} onClick={() => {
                                    this.props.onSelectDeviceType(id);
                                }}>{name}</Button>
                            });
                        }}
                    </Query>
                </div>
            </div>
        );
    }
}