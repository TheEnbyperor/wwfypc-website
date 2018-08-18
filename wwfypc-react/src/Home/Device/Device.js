import React, {Component} from 'react';
import {Query} from "react-apollo";
import gql from "graphql-tag";
import "./style/Device.scss";
import Indicators from "./Indicators";
import RepairSelection from './Repair';
import {BASE_URL} from "../../App";

const DEVICES_QUERY = gql`
  {
    deviceCategories {
      id
      icon
      name
    }
  }
`;

class Devices extends Component {
    render() {
        return (
            <div className="Devices">
                <div>
                    <Query query={DEVICES_QUERY}>
                        {({loading, error, data}) => {
                            if (loading) return <h2>Loading</h2>;
                            if (error) return <h2>Error</h2>;

                            return data.deviceCategories.map(({id, icon, name}) => (
                                <img src={BASE_URL + icon} alt={name} key={id} onClick={() => this.props.onSelect(id)}/>
                            ))
                        }}
                    </Query>
                </div>
            </div>
        );
    }
}

export default class Device extends Component {
    constructor(props) {
        super(props);

        this.state = {
            deviceType: null,
        };

        this.selectType = this.selectType.bind(this);
        this.goBack = this.goBack.bind(this);
    }

    selectType(type) {
        this.setState({
            deviceType: type,
        })
    }

    goBack() {
        if (this.state.deviceType !== null) {
            this.setState({
                deviceType: null,
            })
        }
    }

    render() {
        let step = null;
        let disp = null;

        if (this.state.deviceType === null) {
            step = 1;
            disp = <Devices onSelect={this.selectType}/>;
        } else {
            step = 2;
            disp = <RepairSelection deviceCategory={this.state.deviceType}/>;
        }

        return (
            <div className={"Device step-" + step}>
                <h1>Select your device</h1>
                <div className="BackButton" onClick={this.goBack}>➜</div>
                <Indicators steps={4} step={step}/>
                {disp}
            </div>
        );
    }
}