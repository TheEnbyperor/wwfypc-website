import React, {Component} from 'react';
import gql from 'graphql-tag';
import Footer from "../Shared/Footer/Footer";
import "./style/Contact.scss";
import {Query, Mutation} from "react-apollo";
import Button from '../Shared/Buttons';
import {Link} from "react-router-dom";
import DocumentTitle from "react-document-title";

const INFO_QUERY = gql`
  query {
    siteConfig {
      landline
      mobile
      openingHours
      address
      email
      facebookUrl
      googleUrl
      twitterUrl
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
        window.$.scrollify({
            section: ".section",
            sectionName : "anchor",
            interstitialSection: ".fp-auto-height",
        })
    }

    componentWillUnmount() {
        window.$.scrollify.destroy();
    }

    submit() {
        this.setState({
            submitted: true,
        });
    }

    render() {
        return <DocumentTitle title="Contact | We Will Fix Your PC">
            <div className="Contact">
                <div className={"section ContactInner" + (this.state.submitted ? " orange" : "")} data-anchor="contact">
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
                                            <p dangerouslySetInnerHTML={{__html: data.siteConfig.address}}/>
                                            <p dangerouslySetInnerHTML={{__html: data.siteConfig.openingHours}}/>
                                            <div className="icon">
                                                <i className="fa fa-phone"/>
                                                <p>
                                                    <a href={"tel:" + data.siteConfig.landline}>
                                                        {data.siteConfig.landline}
                                                    </a>
                                                    <br/>
                                                    <a href={"tel:" + data.siteConfig.mobile}>
                                                        {data.siteConfig.mobile}
                                                    </a>
                                                </p>
                                            </div>
                                            <div className="icon">
                                                <i className="fa fa-envelope"/>
                                                <p>
                                                    <a href={"mailto:" + data.siteConfig.email}>
                                                        {data.siteConfig.email}
                                                    </a>
                                                </p>
                                            </div>
                                            <div className="social">
                                                <a href={data.siteConfig.facebookUrl} target="_blank">
                                                    <i className="fab fa-facebook-f"/>
                                                </a>
                                                <a href={data.siteConfig.googleUrl} target="_blank">
                                                    <i className="fab fa-google"/>
                                                </a>
                                                <a href={data.siteConfig.twitterUrl} target="_blank">
                                                    <i className="fab fa-twitter"/>
                                                </a>
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
                <div className="section fp-auto-height" data-anchor="footer"><Footer/></div>
            </div>
        </DocumentTitle>;
    }
}