import React, {Component} from "react";
import './style/BuyAndSell.scss';

import Menu from "../Shared/Menu";
import Filter from "./Filter/Filter";
import Items from "./Items/Items";

export default class BuyAndSell extends Component {
    constructor(props) {
        super(props);

        this.selectCategory = this.selectCategory.bind(this);

        this.state = {
            selectedCategory: null
        }
    }

    selectCategory(i) {
        console.log(i, i === this.state.selectedCategory);
        if (i === this.state.selectedCategory) {
            this.setState({
                selectedCategory: null
            })
        } else {
            this.setState({
                selectedCategory: i
            })
        }
    }

    render() {
        return (
            <div className="BuyAndSell">
                <Menu/>
                <section>
                    <h1 className="large">Buy & Sell</h1>
                    <Filter onSelect={this.selectCategory}/>
                    <Items selectedCategory={this.state.selectedCategory}/>
                </section>
            </div>
        )
    }
}