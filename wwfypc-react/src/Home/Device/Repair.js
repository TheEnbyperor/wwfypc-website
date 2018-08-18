import React, {Component} from 'react';
import {Query} from "react-apollo";
import gql from "graphql-tag";
import "./style/Repair.scss";
import Button from '../../Shared/Buttons';

import iPhone from './img/iPhone-small.png';
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

const REPAIR_INFO_QUERY = gql`
  query ($deviceType: ID!, $repairType: ID!) {
    deviceType(id: $deviceType) {
      name
    }
    repairType(id: $repairType) {
      price
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
                                <p>{description}</p>
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

class RepairInfo extends Component {
    render() {
        let disp = null;
        if (this.props.deviceType !== null && this.props.repairType !== null) {
            disp = <Query query={REPAIR_INFO_QUERY} variables={{
                deviceType: this.props.deviceType,
                repairType: this.props.repairType
            }}>
                {({loading, error, data}) => {
                    if (loading) return <h2>Loading</h2>;
                    if (error) return <h2>Error</h2>;

                    return ([
                        <img src={iPhone} alt="iPhone"/>,
                        <h2>{data.deviceType.name}</h2>,
                        <div className="info">,
                            <ul>
                                <li>In stock</li>
                                <li>15 Minutes</li>
                            </ul>
                            <div className="price">
                                &pound;{data.repairType.price}
                            </div>
                        </div>,
                        <Button colour={1}>
                            Fix your device now
                        </Button>
                    ]);
                }}
            </Query>;
        }
        return (
            <div className="Info">
                <div>
                    {disp}
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
        };

        this.selectModel = this.selectModel.bind(this);
        this.selectRepair = this.selectRepair.bind(this);
        this.openRepairDetail = this.openRepairDetail.bind(this);
    }

    selectModel(model) {
        this.setState({
            selectedModel: model,
            selectedRepair: null,
        })
    }

    selectRepair(repair) {
        this.setState({
            selectedRepair: repair
        })
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

    render() {
        let stage = "stage-1";
        if (this.state.selectedModel !== null) {
            stage = "stage-2"
        }
        if (this.state.selectedRepair !== null) {
            stage = "stage-3"
        }

        return (
            <div className="RepairSelection">
                <div className={stage}>
                    <div className="Select ">
                        <RepairModels category={this.props.deviceCategory} selectedModel={this.state.selectedModel}
                                      selectModel={this.selectModel}/>
                        <RepairTypes deviceType={this.state.selectedModel} selectedRepair={this.state.selectedRepair}
                                     selectedRepairDetail={this.state.selectedRepairDetail} selectRepair={this.selectRepair}
                                     openRepairDetail={this.openRepairDetail}/>
                    </div>
                    <RepairInfo deviceType={this.state.selectedModel} repairType={this.state.selectedRepair}/>
                </div>
            </div>
        );
    }
}