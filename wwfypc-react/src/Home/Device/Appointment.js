import React, {Component} from 'react';
import Button from '../../Shared/Buttons';
import './style/Appointment.scss';
import {Mutation, Query} from "react-apollo";
import gql from "graphql-tag";
import {BASE_URL} from "../../App";
import dateformat from 'dateformat';

const REPAIR_INFO_QUERY = gql`
  query ($deviceType: ID!, $repairType: ID!) {
    deviceType(id: $deviceType) {
      name
      deviceCategory {
        icon
      }
    }
    repairType(id: $repairType) {
      name
      price
      repairTime
    }
  }
`;

const BOOKING_TIMES_QUERY = gql`
  query ($day: Date!) {
    appointmentTimes(date: $day) {
      time
      booked
    }
  }
`;

const WALK_IN_QUERY = gql`
  {
    siteConfig {
      address
      googleMapsPlaceId
      openingHours
    }
  }
`;

const CREATE_ORDER_QUERY = gql`
  mutation($name: String!, $email: String!, $phone: String!, $date: Date!, $time: Time! $device: ID!, $repair: ID!) {
    createAppointment(name: $name, email: $email, phone: $phone, date: $date, time: $time, device: $device, repair: $repair) {
      ok
      errors {
        field
        errors
      }
      appointment {
        uid
      }
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

                    const time2 = new Date(this.props.selectedTime);
                    time2.setHours(time2.getHours() + 1);

                    return [
                        <img key={0} src={BASE_URL + data.deviceType.deviceCategory.icon} alt="iPhone"/>,
                        <h2 key={1}>{data.deviceType.name}</h2>,
                        <div key={2} className="info">
                            <ul>
                                {this.props.selectedDay !== null ?
                                    <li>{dateformat(this.props.selectedDay, "dddd dd/mm/yyyy")}</li> : null}
                                {this.props.selectedTime !== null ?
                                    <li>{dateformat(this.props.selectedTime, "HH:MM")} - {dateformat(time2, "HH:MM")}</li>
                                    : null}
                                <li>{data.repairType.name}</li>
                                <li>{data.repairType.repairTime}</li>
                            </ul>
                        </div>,
                        <div key={3} className="price">
                            &pound;{data.repairType.price}
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
                        <Query key={i} query={BOOKING_TIMES_QUERY}
                               variables={{
                                   day: day.getFullYear().toString() + "-" +
                                       (day.getMonth() + 1).toString().padStart(2, '0') + "-" +
                                       day.getDate().toString().padStart(2, '0')
                               }}>
                            {({data, loading, error}) => {
                                if (loading || error) return (
                                    <div className={"day-" + day.getDay() + " booked"}>
                                        {day.getDate().toString().padStart(2, '0')}
                                    </div>
                                );

                                const valid = (data.appointmentTimes.length !== 0);
                                return (
                                    <div className={"day-" + day.getDay() +
                                    ((this.props.selectedDay !== null && this.props.selectedDay.getTime() === day.getTime()) ? " selected" : "") +
                                    (valid ? "" : " booked")}
                                         onClick={() => this.props.onSelect(day)}>
                                        {day.getDate().toString().padStart(2, '0')}
                                    </div>
                                );
                            }}
                        </Query>
                    )}
                </div>
            </div>
        )
    }
}

class Time extends Component {
    render() {
        if (this.props.selectedDay === null) {
            return <div className="Time"/>;
        }

        return (
            <div className="Time">
                <Query query={BOOKING_TIMES_QUERY}
                       variables={{
                           day: dateformat(this.props.selectedDay, "yyyy-mm-dd")
                       }}>
                    {({data, loading, error}) => {
                        if (loading || error) return null;

                        return data.appointmentTimes.map((time, i) => {
                            const time1 = new Date('1970-01-01T' + time.time + 'Z');
                            const time2 = new Date(time1);
                            time2.setHours(time2.getHours() + 1);
                            if (time.booked) {
                                return <div key={i} className="booked">Booked</div>;
                            } else {
                                return <div key={i}
                                            className={(this.props.selectedTime !== null &&
                                                this.props.selectedTime.getTime() === time1.getTime())
                                                ? "selected" : ""}
                                            onClick={() => this.props.onSelect(time1)}>
                                    {dateformat(time1, "HH:MM")} - {dateformat(time2, "HH:MM")}
                                </div>;
                            }
                        });
                    }}
                </Query>
            </div>
        )
    }
}

class Calendar extends Component {
    render() {
        return (
            <div className="Calendar">
                <Day selectedDay={this.props.selectedDay} onSelect={this.props.onSelectDay}/>
                <Time selectedDay={this.props.selectedDay} selectedTime={this.props.selectedTime}
                      onSelect={this.props.onSelectTime}/>
                <RepairInfo deviceType={this.props.device} repairType={this.props.repair}
                            selectedDay={this.props.selectedDay} selectedTime={this.props.selectedTime}/>
            </div>
        )
    }
}

class AppointmentFinal extends Component {
    render() {
        return <div className="AppointmentFinal">
            <h2>Appointment made</h2>
            <h3>We look forward to seeing you on {dateformat(this.props.selectedDay, "dddd dd/mm/yyyy")}</h3>
            <div className="Info">
                <Query query={WALK_IN_QUERY}>
                    {({loading, error, data}) => {
                        if (loading) return <h2>Loading</h2>;
                        if (error) return <h2>Error</h2>;

                        return [
                            <div key={0}>
                                <h2>Opening Hours</h2>
                                <p dangerouslySetInnerHTML={{__html: data.siteConfig.openingHours}}/>
                            </div>,
                            <div key={1}>
                                <h2>Address</h2>
                                <p dangerouslySetInnerHTML={{__html: data.siteConfig.address}}/>
                            </div>,
                            <div key={2}>
                                <iframe title="google map" frameBorder="0" style={{border: 0}}
                                        src={"https://www.google.com/maps/embed/v1/place?q=place_id:" +
                                        data.siteConfig.googleMapsPlaceId +
                                        "&key=AIzaSyBmGRHy0mtaNM6QNZdK2Cku3yt_u__AyBs"} allowFullScreen/>
                            </div>,
                            <RepairInfo key={3} deviceType={this.props.device} repairType={this.props.repair}
                                        selectedDay={this.props.selectedDay} selectedTime={this.props.selectedTime}/>
                        ];
                    }}
                </Query>
            </div>
            <Button colour={3} onClick={this.props.onSelectDone}>Done</Button>
            <Button colour={4} onClick={this.props.onSelectBack}>Back</Button>
        </div>
    }
}

class AppointmentForm extends Component {
    constructor(props) {
        super(props);

        this.state = {};

        this.name = React.createRef();
        this.email = React.createRef();
        this.phone = React.createRef();

        this.submit = this.submit.bind(this);
    }

    submit(createOrder) {
        createOrder({
            variables: {
                name: this.name.current.value,
                email: this.email.current.value,
                phone: this.phone.current.value,
                date: dateformat(this.props.selectedDay, "yyyy-mm-dd"),
                time: dateformat(this.props.selectedTime, "HH:MM", true),
                device: this.props.device,
                repair: this.props.repair,
            }
        });
    }

    render() {
        return <div className="AppointmentForm">
            <h2>Enter your details</h2>,
            <Mutation mutation={CREATE_ORDER_QUERY}>
                {(createOrder, {data, error, loading, called}) => {
                    if (error) return <h2>Error</h2>;

                    let errors = {};

                    if (called && !loading) {
                        if (!data.createAppointment.ok) {
                            data.createAppointment.errors.forEach((error) => {
                                errors[error.field] = <p>{error.errors.join(", ")}</p>;
                            });
                        } else {
                            this.props.onSubmit(data.createAppointment.appointment.uid);
                        }
                    }

                    return (
                        <div className="AppointmentFormInner">
                            <div className="input">
                                {errors["name"]}
                                <input type="text" ref={this.name} placeholder="Name"/>
                            </div>
                            <div className="input">
                                {errors["email"]}
                                <input type="email" ref={this.email} placeholder="Email"/>
                            </div>
                            <div className="input">
                                {errors["phone"]}
                                <input type="phone" ref={this.phone} placeholder="Phone"/>
                            </div>
                            <Button colour={1} onClick={() => this.submit(createOrder)}>Submit</Button>
                            <Button colour={4} onClick={this.props.onSelectBack}>Back</Button>
                        </div>);
                }}
            </Mutation>
        </div>
    }
}

export default class Appointment extends Component {
    constructor(props) {
        super(props);

        this.state = {
            selectedDay: null,
            selectedTime: null,
            timeSelected: false,
            appointmentID: null,
        };

        this.selectDay = this.selectDay.bind(this);
        this.selectTime = this.selectTime.bind(this);
        this.book = this.book.bind(this);
        this.submit = this.submit.bind(this);
    }

    selectDay(day) {
        this.setState({
            selectedDay: day,
            selectedTime: null
        });
    }

    selectTime(time) {
        this.setState({
            selectedTime: time,
        });
    }

    book() {
        this.setState({
            timeSelected: true,
        });
    }

    submit(id) {
        this.setState({
            appointmentID: id,
        });
    }

    render() {
        return (
            <div className="Appointment">
                {(this.state.timeSelected === false) ? [
                    <Calendar key={0} repair={this.props.repair} device={this.props.device}
                              selectedDay={this.state.selectedDay} selectedTime={this.state.selectedTime}
                              onSelectDay={this.selectDay} onSelectTime={this.selectTime}/>,
                    (this.state.selectedDay !== null && this.state.selectedTime !== null) ?
                        <Button key={1} colour={1} onClick={this.book}>Book</Button> : null,
                    <Button key={2} colour={4} onClick={this.props.onSelectBack}>Back</Button>
                ] : (this.state.appointmentID === null) ?
                    <AppointmentForm repair={this.props.repair} device={this.props.device}
                                     selectedDay={this.state.selectedDay} selectedTime={this.state.selectedTime}
                                     onSubmit={this.submit} onSelectBack={this.props.onSelectBack}/> :
                    <AppointmentFinal repair={this.props.repair} device={this.props.device}
                                      selectedDay={this.state.selectedDay} selectedTime={this.state.selectedTime}
                                      onSelectBack={this.props.onSelectBack} onSelectDone={this.props.onSelectDone}/>
                }
            </div>
        )
    }
}