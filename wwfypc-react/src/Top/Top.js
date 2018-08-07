import React, {Component} from 'react';
import Menu from './Menu';
import Button from '../Shared/Buttons';
import './style/Top.scss';
import iPhone from './img/iphone-x.png';
import PostIt from './img/post-it.svg';

class TopLeft extends Component {
    render() {
        return (
            <div className="TopLeft">
                <h2>Welcome to</h2>
                <h1>We Will Fix Your PC</h1>
                <p>You've arrived at We Will Fix Your PC. <br/> If your looking for expert help with your computer or
                    phone - without breaking the bank, then search no further.</p>
                <div className="buttons">
                    <Button colour={1}>Start your repair</Button>
                    <Button colour={2}>Learn more</Button>
                </div>
            </div>
        )
    }
}

function getRenderedSize(contains, cWidth, cHeight, width, height, pos){
  var oRatio = width / height,
      cRatio = cWidth / cHeight;
  return function() {
    if (contains ? (oRatio > cRatio) : (oRatio < cRatio)) {
      this.width = cWidth;
      this.height = cWidth / oRatio;
    } else {
      this.width = cHeight * oRatio;
      this.height = cHeight;
    }
    this.left = (cWidth - this.width)*(pos/100);
    this.right = this.width + this.left;
    return this;
  }.call({});
}

function getImgSizeInfo(img, width) {
  var pos = window.getComputedStyle(img).getPropertyValue('object-position').split(' ');
  return getRenderedSize(true,
                         img.width,
                         img.height,
                         width,
                         img.naturalHeight,
                         parseInt(pos[0]));
}

class TopRight extends Component {
    constructor(props) {
        super(props);

        this.updateDimensions = this.updateDimensions.bind(this);
    }

    updateDimensions() {
        const img = this.refs.img;
        const size = getImgSizeInfo(img, 338);

        this.refs.slides.setAttribute("style", "width: " + size.width + "px;");
    }

    componentDidMount() {
        window.addEventListener("resize", this.updateDimensions);
        setTimeout(this.updateDimensions, 500);
    }
    componentWillUnmount() {
        window.removeEventListener("resize", this.updateDimensions);
    }

    render() {
        return (
            <div className="TopRight">
                    <div className="TopSlider">
                        <div className="TopSlidesInner">
                            <div className="SliderImg">
                                <img src={iPhone} alt="" className="overlay" ref="img"/>
                            </div>
                            <div className="TopSlides" ref="slides">
                                <div className="TopSlide">
                                    <div className="TopImg">
                                        <img src={PostIt} alt=""/>
                                    </div>
                                    <h2>Post it</h2>
                                    <p>Now you can mail in your devices, we'll repair them and ship them back safely</p>
                                    <Button colour={1}>Mail in your device</Button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        )
    }
}

export default class Top extends Component {
    render() {
        return (
            <header className="Top">
                <Menu/>
                <div className="TopContent">
                    <TopLeft/>
                    <TopRight/>
                </div>
            </header>
        )
    }
}