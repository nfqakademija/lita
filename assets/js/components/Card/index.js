import React, { PureComponent } from 'react';
import './card.scss';
import PropTypes from "prop-types";

class Card extends PureComponent {
    render() {
        const { academy } = this.props;
        return (
            <div className="card promoting-card">
                <div className="card-body d-flex flex-row">
                    <img src={academy.academy_logo} className="logo rounded-circle mr-3" alt="..." />
                    <div className="card-body">
                            <h5 className="card-title">{academy.academy_name}</h5>
                            <p className="card-text"><i className="fa fa-clock-o pr-2" />2019-11-14</p>
                            <p className="card-text">{academy.description ? academy.description : 'Super cool academy, with tons of homeworks'}</p>
                            <p className="card-email">{academy.academy_email}</p>
                            <div>Price: <span className="price">{academy.price ? academy.price : 'Free'}</span></div>
                            <a href={academy.academy_url} className="btn btn-primary">Academy page link</a>
                    </div>
                </div>
            </div>
        );
    }
}

Card.propTypes = {
    academy: PropTypes.shape({
        academy_logo: PropTypes.string,
        academy_name: PropTypes.string,
        description: PropTypes.string,
        academy_email: PropTypes.string,
        price: PropTypes.oneOfType([PropTypes.string, PropTypes.bool]),
        academy_url: PropTypes.string,
    })
};


export default Card;