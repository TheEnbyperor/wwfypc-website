import React, {Component} from "react";
import {Query, Mutation} from 'react-apollo';
import gql from 'graphql-tag';
import Button from '../../Shared/Buttons';
import {BASE_URL} from "../../App";
import './style/Post.scss'

const POST_INFO_QUERY = gql`
  {
    siteConfig {
      address
    }
  }
`;

const CREATE_ORDER_QUERY = gql`
  mutation($name: String!, $email: String!, $phone: String!, $address: String!, $additionalItems: String!, $device: ID!, $repair: ID!) {
    createPostalOrder(name: $name, email: $email, phone: $phone, address: $address, additionalItems: $additionalItems, device: $device, repair: $repair) {
      ok
      errors {
        field
        errors
      }
      order {
        uid
      }
    }
  }
`;

class PostFinal extends Component {
    render() {
        return [
            <h2 key={1}>Follow these easy steps to post your device to us</h2>,
            <Query key={2} query={POST_INFO_QUERY}>
                {({loading, error, data}) => {
                    if (loading) return <h2>Loading</h2>;
                    if (error) return <h2>Error</h2>;

                    return (
                        <div className="Info">
                            <div>
                                <h2>Step 1: Print this out</h2>
                                <p>Print this sheet out and put it in the box with your device</p>
                                <p><a href={BASE_URL + "/post_form/" + this.props.orderId}
                                      target="_blank">Click here</a> to download the sheet</p>
                            </div>
                            <div>
                                <h2>Step 2: Post it to us</h2>
                                <p>{data.siteConfig.address}</p>
                                <p>Note: You will have to pay postage</p>
                            </div>
                            <div>
                                <h2>Step 3: We'll repair your device</h2>
                                <p>We'll be in touch once your device is fixed to take payment and to arrange postage
                                    back to you</p>
                            </div>
                        </div>
                    );
                }}
            </Query>
        ];
    }
}

class PostForm extends Component {
    constructor(props) {
        super(props);

        this.state = {};

        this.name = React.createRef();
        this.email = React.createRef();
        this.phone = React.createRef();
        this.additional = React.createRef();
        this.address = React.createRef();

        this.submit = this.submit.bind(this);
    }

    submit(createOrder) {
        console.log(createOrder, this.name);
        createOrder({
            variables: {
                name: this.name.current.value,
                email: this.email.current.value,
                phone: this.phone.current.value,
                address: this.address.current.value,
                additionalItems: this.additional.current.value,
                device: this.props.device,
                repair: this.props.repair,
            }
        });
    }

    render() {
        return [
            <h2 key={1}>Enter your details, and any aditionals items you'll be putting in the box</h2>,
            <Mutation key={2} mutation={CREATE_ORDER_QUERY}>
                {(createOrder, {data, error, loading, called}) => {
                    if (error) return <h2>Error</h2>;

                    let errors = {};

                    if (called && !loading) {
                        if (!data.createPostalOrder.ok) {
                            data.createPostalOrder.errors.forEach((error) => {
                                errors[error.field] = <p>{error.errors.join(", ")}</p>;
                            });
                        } else {
                            this.props.onSubmit(data.createPostalOrder.order.uid);
                        }
                    }

                    return (
                        <div key={2} className="PostForm">
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
                            <div className="input">
                                {errors["additionalItems"]}
                                <input type="text" ref={this.additional} placeholder="Additional items"/>
                            </div>
                            <div className="textarea">
                                {errors["address"]}
                                <textarea name="address" ref={this.address} placeholder="Address"/>
                            </div>
                            <Button colour={1} onClick={() => this.submit(createOrder)}> Get your postage sheet</Button>
                        </div>);
                }}
            </Mutation>
        ];
    }
}

export default class Post extends Component {
    constructor(props) {
        super(props);

        this.state = {
            orderId: null,
        };

        this.onSubmitOrder = this.onSubmitOrder.bind(this);
    }

    onSubmitOrder(id) {
        this.setState({
            orderId: id
        });
        this.props.nextStep();
    }

    render() {
        let disp = null;

        if (this.state.orderId === null) {
            disp = <PostForm onSubmit={this.onSubmitOrder} device={this.props.device} repair={this.props.repair} />;
        } else {
            disp = <PostFinal orderId={this.state.orderId}/>;
        }

        return (
            <div className="Post">
                {disp}
            </div>
        );
    }
}