import React, { Component } from 'react';
import "./style/iPhone.scss";
import Button from '../Shared/Buttons';

import iPhone from './img/iPhone-small.png';
import Arrow from './img/Arrow.svg';

export default class IPhoneSelection extends Component {
    constructor(props) {
        super(props);

        this.state = {
          selectedModel: null,
          selectedRepair: null,
          selectedRepairDetail: null,
        };

        this.selectModel = this.selectModel.bind(this);
        this.selectRepair = this.selectRepair.bind(this);
        this.openRepairDetail = this.openRepairDetail.bind(this);
    }

    selectModel(model) {
        this.setState({
            selectedModel: model,
            selectedRepair: null,
        })
    }

    selectRepair(repair) {
        this.setState({
            selectedRepair: repair
        })
    }

    openRepairDetail(repair) {
        if (this.state.selectedRepairDetail === repair) {
            this.setState({
                selectedRepairDetail: null
            })
        } else {
            this.setState({
                selectedRepairDetail: repair
            })
        }
    }

    render() {
        const modelNames = ["iPhone 5", "iPhone 5S", "iPhone 5C", "iPhone SE", "iPhone 6", "iPhone 6+", "iPhone 6S",
            "iPhone 6S+", "iPhone 7", "iPhone 7+", "iPhone 8", "iPhone 8+"];
        const models = modelNames.map((name, i) =>
            <div className={"model" + ((this.state.selectedModel === i) ? " selected" : "")} key={i}
                 onClick={() => this.selectModel(i)}>
                <span>{name}</span>
            </div>
        );

        const repairTypeNames = ["Screen", "Battery", "Charging Port", "Camera", "Other", "Not sure"];
        const repairTypes = repairTypeNames.map((name, i) =>
            <div className={"repairType" + ((this.state.selectedRepair === i) ? " selected" : "") +
            ((this.state.selectedRepairDetail === i) ? " open" : "")} key={i}
                 onClick={() => this.selectRepair(i)}>
                <div className="top">
                    <span>{name}</span>
                    <img src={Arrow} alt="" onClick={() => this.openRepairDetail(i)}/>
                </div>
            </div>
        );

        let stage = "stage-1";
        if (this.state.selectedModel !== null) {
            stage = "stage-2"
        }
        if (this.state.selectedRepair !== null) {
            stage = "stage-3"
        }

        return (
          <div className={"iPhoneSelection " + stage}>
              <div className="Select ">
                  {models}
                  {repairTypes}
              </div>
              <div className="Info">
                  <div>
                      <img src={iPhone} alt="iPhone" />
                      <h2>{modelNames[this.state.selectedModel]}</h2>
                      <div className="info">
                          <ul>
                              <li>In stock</li>
                              <li>15 Minutes</li>
                          </ul>
                          <div className="price">
                              &pound;45
                          </div>
                      </div>
                      <Button colour={1}>
                          Fix your device now
                      </Button>
                  </div>
              </div>
          </div>
        );
    }
}