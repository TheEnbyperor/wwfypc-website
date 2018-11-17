import React, {Component} from "react";
import {withRouter} from 'react-router-dom';
import gql from 'graphql-tag';
import {Query} from 'react-apollo';
import './style/Items.scss';
import Button from '../../Shared/Buttons';
import {addToCart, getItem} from "../../Cart/Cart";
import {BASE_URL} from "../../App";

const ITEM_QUERY = gql`
  query ($category: ID) {
    buyAndSellItems(category: $category) {
      id
      name
      reserved
      price
      category {
        colour
      }
      specs {
        name
        value
      }
      images {
        image
        id
      }
    }
  }
`;

class Indicators extends Component {
    render() {
        let indicators = [];
        for (let i = 0; i < this.props.num; i++) {
            indicators.push(<div className={"Indicator" + ((this.props.active === i) ? " active" : "")}
                                 key={i} onClick={() => this.props.onSelect(i)}/>)
        }
        return (
            <div className="Slide-Indicators">
                {indicators}
            </div>
        )
    }
}

class item extends Component {
    constructor(props) {
        super(props);

        this.setSlide = this.setSlide.bind(this);
        this.addToCart = this.addToCart.bind(this);
        this.toggleExpand = this.toggleExpand.bind(this);

        this.state = {
            activeSlide: 0,
            expanded: false,
        };
    }

    setSlide(nextSlide) {
        if (nextSlide >= this.props.item.images.length) {
            nextSlide = 0;
        }

        const activeSlide = this.state.activeSlide;
        let slide = activeSlide - 1;
        if (nextSlide > activeSlide) {
            slide = activeSlide + 1;
        }
        if (nextSlide === 0 && activeSlide === this.props.item.images.length - 1) {
            slide = 0;
        }
        this.setState({
            activeSlide: slide
        });
        if (slide !== nextSlide) {
            setTimeout(() => {this.setSlide(nextSlide)}, 500);
        }
    }

    addToCart() {
        const item = getItem("buy_and_sell", this.props.item.id);
        if (typeof item !== "undefined") {
            if (item.quantity >= 1) {
                return;
            }
        }
        addToCart("buy_and_sell", this.props.item.id);
        this.props.history.push("/cart");
    }

    toggleExpand() {
        this.setState({
            expanded: !this.state.expanded
        });
    }

    render() {
        const prevActive = (this.state.activeSlide === 0) ? this.props.item.images.length - 1 : this.state.activeSlide - 1;
        const nextActive = ((this.state.activeSlide + 1) >= this.props.item.images.length) ? 0 : this.state.activeSlide + 1;
        const slidesDisp = this.props.item.images.map((slide, i) =>
            <img className={((i === this.state.activeSlide) ? "active" : "") + ((i === prevActive) ? " prevActive" : "")
            + ((i === nextActive) ? " nextActive" : "")} key={slide.id} src={BASE_URL + slide.image} alt=""/>
        );

        let inCart = false;
        const item = getItem("buy_and_sell", this.props.item.id);
        if (typeof item !== "undefined") {
            if (item.quantity >= 1) {
                inCart = true;
            }
        }

        return (
            <div className={"Item" + ((this.props.item.reserved) ? " reserved" : "")
            + (this.state.expanded ? " open" : " closed")}>
                <div className="ImgSlider">
                    {slidesDisp}
                </div>
                <Indicators num={this.props.item.images.length} active={this.state.activeSlide} onSelect={this.setSlide}/>
                <h2>{this.props.item.name}</h2>
                <div className="price">
                    &pound;{this.props.item.price}
                    <span>(inc. VAT)</span>
                </div>
                <div className="expand" onClick={this.toggleExpand}>
                    <span>{this.state.expanded ? "Less info" : "More info"}</span>
                    <i className="fas fa-caret-down"/>
                </div>
                <div className="specs">
                    {this.props.item.specs.map((spec) => {
                        return [
                            <span key={1}>{spec.name}:</span>,
                            <span key={2}>{spec.value}</span>
                        ]
                    })}
                </div>
                <div className="buttons">
                    {!inCart ?
                        <Button colour={this.props.item.category.colour} small onClick={this.addToCart}>
                            Add to cart
                        </Button>
                        :
                        <Button colour={this.props.item.category.colour} small>
                            Added to cart
                        </Button>
                    }
                    {/*<Button colour={this.props.item.category.colour} small>*/}
                        {/*Reserve*/}
                    {/*</Button>*/}
                </div>
                <div className="reserved">
                    <p>Reserved</p>
                    <p>Get an email if item becomes available?</p>
                    <Button colour={1} small>Sumbit email</Button>
                </div>
            </div>
        )
    }
}
const Item = withRouter(item);

export default class Items extends Component {
    render() {
        return (
            <div className="BuyAndSellItems">
                <Query query={ITEM_QUERY} variables={{category: this.props.selectedCategory}}>
                    {({loading, error, data}) => {
                        if (loading) return null;
                        if (error) return <h2>Error</h2>;

                        setTimeout(window.$.scrollify.update, 500);

                        return data.buyAndSellItems.map((item) => {
                            return <Item key={item.id} item={item}/>
                        })
                    }}
                </Query>
            </div>
        )
    }
}