import React, {Component} from 'react';
import gql from 'graphql-tag';
import {WORLDPAY_KEY, client} from "../App";
import Button from "../Shared/Buttons";

const MAKE_ORDER = gql`
  mutation($name: String!, $nameOnCard: String!, $email: String!, $phone: String!, $address: String!,
             $cardToken: String!, $items: [OrderItemInput!]!) {
    createOrder(name: $name, nameOnCard: $nameOnCard, email: $email, phone: $phone, address: $address,
                  cardToken: $cardToken, items: $items) {
      ok
      errors {
        field
        errors
      }
    }
  }
`;

export default class Payment extends Component {
    constructor(props) {
        super(props);

        this.state = {
            cardError: null,
            cardName: null,
            token: null,
            error: false,
            called: false,
            data: null,
        };

        this.name = React.createRef();
        this.email = React.createRef();
        this.phone = React.createRef();
        this.address = React.createRef();
        this.nameOnCard = React.createRef();
        this.cardNumber = React.createRef();
        this.expMonth = React.createRef();
        this.expYear = React.createRef();
        this.cvc = React.createRef();

        this.updateCardInfo = this.updateCardInfo.bind(this);
        this.submit = this.submit.bind(this);
    }

    updateCardInfo() {
        let expMonth = parseInt(this.expMonth.current.value, 10);
        let expYear = parseInt(this.expYear.current.value, 10);
        if (expYear < 100) {
            expYear += Math.floor(new Date().getFullYear() / 100) * 100;
        }

        return fetch("https://api.worldpay.com/v1/tokens", {
            method: "POST",
            headers: {
                "Content-Type": "application/json; charset=utf-8",
            },
            body: JSON.stringify({
                reusable: true,
                clientKey: WORLDPAY_KEY,
                paymentMethod: {
                    type: "Card",
                    name: this.nameOnCard.current.value,
                    expiryMonth: expMonth,
                    expiryYear: expYear,
                    cardNumber: this.cardNumber.current.value,
                    cvc: this.cvc.current.value,
                }
            }),
        })
            .then(resp => {
                if (!resp.ok) {
                    throw resp.json();
                }
                return resp.json()
            })
            .then(resp => {
                this.setState({
                    cardError: null,
                    token: resp.token,
                    cardName: resp.paymentMethod.cardIssuer + " " + resp.paymentMethod.cardSchemeName,
                });
            })
            .catch(error => {
                error.then(data => {
                    this.setState({
                        cardError: data.message,
                        cardName: null,
                        token: null,
                    });
                });
            })
    }

    submit() {
        this.updateCardInfo().then(() => {
            if (this.state.token !== null) {
                client.mutate({
                    mutation: MAKE_ORDER,
                    variables: {
                        name: this.name.current.value,
                        email: this.email.current.value,
                        phone: this.phone.current.value,
                        address: this.address.current.value,
                        nameOnCard: this.nameOnCard.current.value,
                        cardToken: this.state.token,
                        items: this.props.cart.map(item => ({
                            type: item.type,
                            id: item.id,
                            quantity: item.quantity,
                            delivery: item.selectedDelivery,
                        }))
                    }
                })
                    .then(({data, error}) => {
                        console.log(data, error);
                        if (data.createOrder.ok) {
                            setTimeout(this.props.onSubmit, 500);
                        } else {
                            this.setState({
                                called: true,
                                error: error,
                                data: data,
                            });
                        }
                })
            }
        });
    }

    render() {
        let errors = {};

        if (this.state.error) {
            errors["generic"] = <h3>There was an error, please try again</h3>;
        } else {
            if (this.state.called) {
                if (!this.state.data.createOrder.ok) {
                    this.state.data.createOrder.errors.forEach((error) => {
                        errors[error.field] = <p>{error.errors.join(", ")}</p>;
                    });
                }
            }
        }

        return <div className="Payment">
            <h1>Payment</h1>
            {errors["generic"]}
            <div>
                <h2>Personal details</h2>
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
                    {errors["address"]}
                    <textarea name="address" ref={this.address} placeholder="Address"/>
                </div>
            </div>
            <div>
                <h2>Payment details</h2>
                {this.state.cardError === null && this.state.cardName === null &&
                typeof errors["card"] === "undefined" ? null :
                    <div>
                        {this.state.cardError === null ? null : <h3>{this.state.cardError}</h3>}
                        {this.state.cardName === null ? null : <h3>Card type: {this.state.cardName}</h3>}
                        {errors["card"]}
                    </div>
                }
                <div className="input">
                    <input type="text" ref={this.nameOnCard} placeholder="Name on Card"
                           onChange={this.updateCardInfo}/>
                </div>
                <div className="input">
                    <input type="text" ref={this.cardNumber} placeholder="Card number"
                           onChange={this.updateCardInfo}/>
                </div>
                <div className="input">
                    <div className="inner">
                        <input type="number" ref={this.expMonth} placeholder="Expiry month"
                               onChange={this.updateCardInfo}/>
                        <input type="number" ref={this.expYear} placeholder="Expiry year"
                               onChange={this.updateCardInfo}/>
                    </div>
                </div>
                <div className="input">
                    <input type="number" ref={this.cvc} placeholder="CVC"
                           onChange={this.updateCardInfo}/>
                </div>
            </div>
            <Button colour={3} onClick={this.submit}>Submit</Button>
        </div>;
    }
}