import React, {Component} from 'react';
import {Query} from "react-apollo";
import gql from "graphql-tag";
import "./style/Device.scss";
import Indicators from "../../Shared/Indicators";
import RepairSelection from './Repair';
import {BASE_URL} from "../../App";
import WalkIn from "./WalkIn";
import Post from "./Post";
import Appointment from "./Appointment";
import OtherServices from "./OtherServices/OtherServices";
import Button from "../../Shared/Buttons";

export const APPOINTMENT_TYPE = 0, WALK_IN_TYPE = 1, POST_TYPE = 2;

const DEVICES_QUERY = gql`
  {
    deviceCategories {
      id
      icon
      name
      colour
      description
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

                            return data.deviceCategories.map(({id, icon, name, description, colour}, i) => (
                                <div key={i}>
                                        <img src={BASE_URL + icon} alt={name} key={id}/>
                                        <h3 className={"colour-" + colour} dangerouslySetInnerHTML={{__html: name}} />
                                        <p dangerouslySetInnerHTML={{__html: description}} />
                                    <Button colour={colour} small onClick={() => this.props.onSelect(id)}>Start repair</Button>
                                </div>
                            ))
                        }}
                    </Query>
                </div>
                <div className="other">
                    <Button colour={4} onClick={this.props.onSelectOther}>Other services</Button>
                </div>
            </div>
        );
    }
}

export default class Device extends Component {
    constructor(props) {
        super(props);

        this.repairSelection = React.createRef();

        this.state = {
            deviceType: null,
            device: null,
            repair: null,
            delivery: null,
            step: 1,
            otherServices: false,
        };

        this.selectType = this.selectType.bind(this);
        this.goBack = this.goBack.bind(this);
        this.doGoBack = this.doGoBack.bind(this);
        this.onDone = this.onDone.bind(this);
        this.nextStep = this.nextStep.bind(this);
        this.finalStep = this.finalStep.bind(this);
        this.selectOtherServices = this.selectOtherServices.bind(this);
        this.selectDelivery = this.selectDelivery.bind(this);
        this.selectRepair = this.selectRepair.bind(this);
        this.selectDevice = this.selectDevice.bind(this);
    }

    selectOtherServices(selected) {
        this.setState({
            otherServices: selected
        })
    }

    selectType(type) {
        this.setState({
            deviceType: type,
            repair: null,
            device: null,
            delivery: null,
            step: 2,
        });
        window.history.pushState({page: 1}, "", "");
    }

    doGoBack() {
        if (this.state.delivery === null) {
            this.setState({
                deviceType: null,
                repair: null,
                device: null,
                step: 1,
            });
        } else {
            this.setState({
                delivery: null,
                repair: null,
                device: null,
                step: 2,
            });
        }
    }

    onDone() {
        this.setState({
            deviceType: null,
            repair: null,
            device: null,
            step: 1,
        });
    }

    goBack() {
        if (this.state.delivery !== null) {
            this.doGoBack();
        } else if (this.state.deviceType !== null) {
            this.repairSelection.current.goBack();
        }
    }

    selectDevice(device) {
        this.setState({
            device: device
        });
    }


    selectRepair(repair) {
        this.setState({
            repair: repair
        });
    }

    selectDelivery(delivery) {
        this.setState({
            delivery: delivery
        });
    }

    nextStep() {
        let step = 3;
        if (this.state.delivery === WALK_IN_TYPE) {
            step = 4;
        }
        this.setState({
            step: step,
        });
    }

    finalStep() {
        this.setState({
            step: 4,
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
                            name: "By Post",
                            description: data.siteConfig.postDescription
                        }
                    ];

                    let disp = null;
                    let title = "Select your device";

                    if (this.state.otherServices === true) {
                        title = "Other services";
                        disp = <OtherServices onSelectBack={() => this.selectOtherServices(false)}/>
                    } else if (this.state.deviceType === null) {
                        disp = <Devices onSelect={this.selectType}
                                        onSelectOther={() => this.selectOtherServices(true)}/>;
                    } else if (this.state.step < 3) {
                        disp =
                            <RepairSelection ref={this.repairSelection} goBack={this.doGoBack}
                                             onSelectDeviceType={this.selectType}
                                             onSelectBack={this.goBack} nextStep={this.nextStep}
                                             deviceCategory={this.state.deviceType} devileryTypes={DELIVERY_TYPES}
                                             selectedDevice={this.state.device} selectDevice={this.selectDevice}
                                             selectedRepair={this.state.repair} selectRepair={this.selectRepair}
                                             selectedDelivery={this.state.delivery} selectDelivery={this.selectDelivery}
                            />;
                    } else {
                        if (this.state.delivery === WALK_IN_TYPE) {
                            disp = <WalkIn onSelectBack={this.goBack}/>;
                            title = "Walk in";
                        } else if (this.state.delivery === POST_TYPE) {
                            disp =
                                <Post onSelectBack={this.goBack} nextStep={this.finalStep} device={this.state.device}
                                      repair={this.state.repair}/>;
                            title = "Post";
                        } else if (this.state.delivery === APPOINTMENT_TYPE) {
                            disp = <Appointment device={this.state.device} repair={this.state.repair}
                                                onSelectBack={this.goBack} onSelectDone={this.onDone}/>;
                            title = "Book your appointment";
                        }
                    }

                    return (
                        <div className={"Device step-" + this.state.step}>
                            <div>
                                <h1>{title}</h1>
                                {this.state.otherServices === false ? (
                                    <Indicators steps={4} step={this.state.step}/>
                                ) : null}
                                {disp}
                            </div>
                        </div>
                    );
                }}
            </Query>
        );
    }
}