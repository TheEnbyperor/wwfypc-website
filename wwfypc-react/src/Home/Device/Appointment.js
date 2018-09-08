import React, {Component} from 'react';
import Button from '../../Shared/Buttons';
import './style/Appointment.scss';
import {Query} from "react-apollo";
import gql from "graphql-tag";
import iPhone from "./img/iPhone-small.png";

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

                    return [
                        <img key={1} src={iPhone} alt="iPhone"/>,
                        <h2 key={2}>{data.deviceType.name}</h2>,
                        <div key={3} className="info">
                            <ul>
                                <li>Monday 08/09</li>
                                <li>In stock</li>
                                <li>14:30 - 15:30</li>
                                <li>15 Minutes</li>
                            </ul>
                            <div className="price">
                                &pound;{data.repairType.price}
                            </div>
                        </div>
                    ];
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

class Day extends Component {
    MONTHS = ["January", "Febuary", "March", "April", "May", "June", "July", "August", "September", "October",
        "November", "December"];

    constructor(props) {
        super(props);

        this.nextMonth = this.nextMonth.bind(this);
        this.previousMonth = this.previousMonth.bind(this);
        this.dateToMonth = this.dateToMonth.bind(this);

        const curDate = new Date();
        this.state = {
            curMonth: new Date(curDate.getFullYear(), curDate.getMonth(), 1),
        };
    }

    getDaysInMonth() {
        const month = this.state.curMonth.getMonth();
        const date = new Date(this.state.curMonth);
        const days = [];
        while (date.getMonth() === month) {
            days.push(new Date(date));
            date.setDate(date.getDate() + 1);
        }
        return days;
    }

    dateToMonth() {
        const curDate = new Date();
        let out = this.MONTHS[this.state.curMonth.getMonth()];
        if (this.state.curMonth.getFullYear() !== curDate.getFullYear()) {
            out += " " + this.state.curMonth.getFullYear();
        }
        return out
    }

    nextMonth() {
        const date = this.state.curMonth;
        date.setMonth(date.getMonth() + 1);
        this.setState({
            curMonth: date
        })
    }

    previousMonth() {
        const date = this.state.curMonth;
        date.setMonth(date.getMonth() - 1);
        this.setState({
            curMonth: date
        })
    }

    render() {
        const days = this.getDaysInMonth();

        return (
            <div className="Day">
                <div className="Month">
                    <i className="fas fa-chevron-left" onClick={this.previousMonth}/>
                    <h3>{this.dateToMonth()}</h3>
                    <i className="fas fa-chevron-right" onClick={this.nextMonth}/>
                </div>
                <div className="Days">
                    <div className="name">Mon</div>
                    <div className="name">Tue</div>
                    <div className="name">Wed</div>
                    <div className="name">Thur</div>
                    <div className="name">Fri</div>
                    <div className="name">Sat</div>
                    <div className="name">Sun</div>
                    {days.map((day, i) =>
                        <div key={i} className={"day-" + day.getDay() +
                        ((this.props.selectedDay.getTime() === day.getTime()) ? " selected" : "")}>
                            {day.getDate().toString().padStart(2, '0')}
                        </div>
                    )}
                </div>
            </div>
        )
    }
}

class Time extends Component {
    render() {
        return (
            <div className="Time">
                <div>9:30 - 10:30</div>
                <div>10:30 - 11:30</div>
                <div className="booked">Booked</div>
                <div>12:30 - 13:30</div>
                <div>13:30 - 14:30</div>
                <div className="selected">14:30 - 15:30</div>
                <div>15:30 - 16:30</div>
                <div>16:30 - 17:30</div>
            </div>
        )
    }
}

class Calendar extends Component {
    constructor(props) {
        super(props);

        const curDate = new Date();
        this.state = {
            selectedDay: new Date(curDate.getFullYear(), curDate.getMonth(), curDate.getDate()),
        };
    }

    render() {
        return (
            <div className="Calendar">
                <Day selectedDay={this.state.selectedDay}/>
                <Time selectedDay={this.state.selectedDay}/>
                <RepairInfo deviceType={this.props.device} repairType={this.props.repair}/>
            </div>
        )
    }
}

export default class Appointment extends Component {
    render() {
        return (
            <div className="Appointment">
                <Calendar repair={this.props.repair} device={this.props.device}/>
                <Button colour={1}>Book</Button>
            </div>
        )
    }
}