import React, {Component} from "react";
import './style/BuyAndSell.scss';
import DocumentTitle from 'react-document-title';
import Footer from "../Shared/Footer/Footer";
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

    componentDidMount() {
        window.$.scrollify({
            section: ".section",
            sectionName : "anchor",
            interstitialSection: ".fp-auto-height",
        });
        window.$.scrollify.instantMove("#buy-and-sell");
    }

    componentWillUnmount() {
        window.$.scrollify.destroy();
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
            <DocumentTitle title="Buy & Sell | We Will Fix Your PC">
                <div className="BuyAndSell">
                    <div className="section" data-anchor="buy-and-sell">
                        <section>
                            <Filter onSelect={this.selectCategory}/>
                            <Items selectedCategory={this.state.selectedCategory}/>
                        </section>
                    </div>
                    <div className="section fp-auto-height" data-anchor="footer"><Footer/></div>
                </div>
            </DocumentTitle>
        )
    }
}