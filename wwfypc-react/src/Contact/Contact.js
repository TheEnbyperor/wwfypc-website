import React, {Component} from 'react';
import gql from 'graphql-tag';
import Footer from "../Shared/Footer/Footer";
import "./style/Contact.scss";
import {Query, Mutation} from "react-apollo";
import Button from '../Shared/Buttons';
import {Link} from "react-router-dom";

const INFO_QUERY = gql`
  query {
    siteConfig {
      landline
      mobile
      openingHours
      address
      email
    }
  }
`;

const CONTACT_FORM_QUERY = gql`
  mutation($name: String!, $email: String!, $phone: String!, $message: String!) {
    contactForm(name: $name, email: $email, phone: $phone, message: $message) {
      ok
      errors {
        field
        errors
      }
    }
  }
`;

class ContactForm extends Component {
    constructor(props) {
        super(props);

        this.name = React.createRef();
        this.email = React.createRef();
        this.phone = React.createRef();
        this.message = React.createRef();

        this.sendMessage = this.sendMessage.bind(this);
    }

    sendMessage(sendMessage) {
        sendMessage({
            variables: {
                name: this.name.current.value,
                email: this.email.current.value,
                phone: this.phone.current.value,
                message: this.message.current.value,
            }
        })
    }

    render() {
        return <Mutation mutation={CONTACT_FORM_QUERY}>
            {(sendMessage, {called, error, data, loading}) => {
                if (error) return <h2>Error</h2>;

                let errors = {};

                if (called && !loading) {
                    if (!data.contactForm.ok) {
                        data.contactForm.errors.forEach((error) => {
                            errors[error.field] = <p>{error.errors.join(", ")}</p>;
                        });
                    } else {
                        this.props.onSubmit();
                    }
                }

                return <div className="ContactForm">
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
                    <div className="textarea">
                        {errors["message"]}
                        <textarea name="message" ref={this.message} placeholder="Your message"/>
                    </div>
                    <Button colour={3} onClick={() => this.sendMessage(sendMessage)}>Submit</Button>
                </div>
            }}
        </Mutation>;
    }
}

class Success extends Component {
    render() {
        return <div className="ContactSuccess">
            <h1>Success!</h1>
            <p>Your message has been sent</p>
            <Link to="/">
                <Button colour={6}>Back to main page</Button>
            </Link>
        </div>
    }
}

export default class Contact extends Component {
    constructor(props) {
        super(props);

        this.state = {
            submitted: false,
        };

        this.submit = this.submit.bind(this);
    }

    componentDidMount() {
        new window.fullpage(".Contact", {
            anchors: ["contact", "footer"],
            navigationTooltips: ["Contact", "Footer"],
            navigationPosition: 'right',
            navigation: true,
            licenseKey: "OPEN-SOURCE-GPLV3-LICENSE",
        })
    }

    componentWillUnmount() {
        window.fullpage_api.destroy();
    }

    submit() {
        this.setState({
            submitted: true,
        });
    }

    render() {
        return <div className="Contact">
            <div className={"section ContactInner" + (this.state.submitted ? " orange" : "")}>
                <div className="inner">
                    <div className="left">
                        {!this.state.submitted ? [
                            <h1 key={0}>Contact</h1>,
                            <ContactForm key={1} onSubmit={this.submit}/>
                        ] : <Success/>}
                    </div>
                    <div className="right">
                        <Query query={INFO_QUERY}>
                            {({loading, error, data}) => {
                                if (!loading && !error) {
                                    return <div>
                                        <p>{data.siteConfig.openingHours}</p>
                                        <div className="icon">
                                            <i className="fa fa-phone"/>
                                            <p>
                                                {data.siteConfig.landline}<br/>
                                                {data.siteConfig.mobile}
                                            </p>
                                        </div>
                                        <div className="icon">
                                            <i className="fa fa-envelope"/>
                                            <p>
                                                {data.siteConfig.email}
                                            </p>
                                        </div>
                                    </div>;
                                } else {
                                    return null;
                                }
                            }}
                        </Query>
                    </div>
                </div>
            </div>
            <div className="section fp-auto-height"><Footer/></div>
        </div>;
    }
}