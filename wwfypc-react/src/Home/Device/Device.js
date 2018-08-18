import React, {Component} from 'react';
import {Query} from "react-apollo";
import gql from "graphql-tag";
import "./style/Device.scss";
import Indicators from "./Indicators";
import RepairSelection from './Repair';
import {BASE_URL} from "../../App";
import WalkIn from "./WalkIn";

export const APPOINTMENT_TYPE = 0, WALK_IN_TYPE = 1, POST_TYPE = 2;

const DEVICES_QUERY = gql`
  {
    deviceCategories {
      id
      icon
      name
    }
  }
`;

const DELIVERY_QUERY = gql`
  {
    siteConfig {
      appointmentDescription
      walkInDescription
      postDescription
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
            device: null,
            repair: null,
            delivery: null
        };

        this.selectType = this.selectType.bind(this);
        this.goBack = this.goBack.bind(this);
        this.doGoBack = this.doGoBack.bind(this);
        this.nextStep = this.nextStep.bind(this);
    }

    selectType(type) {
        this.setState({
            deviceType: type,
        })
    }

    doGoBack() {
        if (this.state.delivery === null) {
            this.setState({
                deviceType: null,
            });
        } else {
            this.setState({
                delivery: null,
                repair: null,
                device: null,
            });
        }
    }

    goBack() {
        if (this.state.deviceType !== null) {
            this.refs.repairSelection.goBack();
        }
    }

    nextStep(device, repair, delivery) {
        this.setState({
            device: device,
            repair: repair,
            delivery: delivery
        });
    }

    render() {
        return (
            <Query query={DELIVERY_QUERY}>
                {({loading, error, data}) => {
                    if (loading) return <div className="Device"><h1>Loading</h1></div>;
                    if (error) return <div className="Device"><h1>Error</h1></div>;

                    const DELIVERY_TYPES = [
                        {
                            id: APPOINTMENT_TYPE,
                            name: "Book an appointment",
                            description: data.siteConfig.appointmentDescription
                        },
                        {
                            id: WALK_IN_TYPE,
                            name: "Walk in",
                            description: data.siteConfig.walkInDescription
                        },
                        {
                            id: POST_TYPE,
                            name: "Post",
                            description: data.siteConfig.postDescription
                        }
                    ];

                    let step = null;
                    let disp = null;

                    if (this.state.deviceType === null) {
                        step = 1;
                        disp = <Devices onSelect={this.selectType}/>;
                    } else if (this.state.delivery === null) {
                        step = 2;
                        disp = <RepairSelection ref="repairSelection" goBack={this.doGoBack} nextStep={this.nextStep}
                                                deviceCategory={this.state.deviceType} devileryTypes={DELIVERY_TYPES}/>;
                    } else {
                        step = 3;

                        if (this.state.delivery === WALK_IN_TYPE) {
                            step = 4;
                            disp = <WalkIn/>;
                        }
                    }

                    return (
                        <div className={"Device step-" + step}>
                            <h1>Select your device</h1>
                            <div className="BackButton" onClick={this.goBack}>➜</div>
                            <Indicators steps={4} step={step}/>
                            {disp}
                        </div>
                    );
                }}
            </Query>
        );
    }
}