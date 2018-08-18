import React, {Component} from "react";
import './style/Filter.scss';

export default class Filter extends Component {
    categories = ["Phones", "Tablets", "Laptops", "Other"];

    render() {
        const disp = this.categories.map((category, i) => {
            return <div onClick={() => {this.props.onSelect(i)}} key={i}>{category}</div>
        });

        return (
            <div className="Filter">
                {disp}
            </div>
        )
    }
}