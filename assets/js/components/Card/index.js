import React, { PureComponent } from 'react';
import { Link } from "react-router-dom";
import PropTypes from "prop-types";
import './card.scss';

class Card extends PureComponent {
    getPrice = () => {
        const { academy } = this.props;
        let price = null;

        if (academy.academy_price.min_price === null && academy.academy_price.max_price === null) {
            price = 'Kaina nenustatyta';
        } else if (academy.academy_price.min_price === '0' && academy.academy_price.max_price === '0') {
            price = 'Nemokama';
        } else if (academy.academy_price.min_price === null) {
            price = (<span><i className="fa fa-eur pr-1" aria-hidden="true"/> 0</span>);
        } else if (academy.academy_price.min_price === academy.academy_price.max_price) {
            price = (<span><i className="fa fa-eur pr-1" aria-hidden="true"/> { academy.academy_price.min_price }</span>);
        } else {
            price = (<span>
                <i className="fa fa-eur pr-1" aria-hidden="true"/> { academy.academy_price.min_price } - { academy.academy_price.max_price }
            </span>);
        }

        return price;
    };

    render() {
        const { academy } = this.props;
        return (
            <div className="card promoting-card flex-wrap flex-row academy-card academy-card--shadow">
                    <div className="col-lg-8 card-body d-flex flex-row p-3">
                        <img src={academy.academy_logo} className="logo rounded-circle mr-3" alt={academy.academy_name} />
                        <div>
                            <h5 className="card-title font-weight-bold mb-2">{academy.academy_name}</h5>
                            <p className="card-text">
                                {academy.academy_description
                                    ? academy.academy_description
                                    : 'Labai puiki akademija, turi daug įvairių programų'
                                }
                            </p>
                        </div>


                    </div>
                    <div className="col-lg-4 p-3 d-flex flex-column justify-content-between card-right">
                        <div className="row justify-content-end">
                            <div className="col-12 text-right">
                                <span className="price">
                                    {this.getPrice()}
                                </span>
                            </div>
                        </div>
                        <div className="d-flex flex-column align-items-end">
                            <div className="mt-3 mb-2">
                                <a
                                    className="btn btn-primary"
                                    rel="noopener noreferrer nofollow"
                                    target="_blank"
                                    href={academy.academy_url}
                                    role="button"
                                >
                                    Akademijos puslapis
                                </a>
                            </div>
                            <Link to={{
                                pathname: `/${academy.academy_id}`,
                                search: location.search,
                            }}>
                                <button type="button" className="btn btn-blue">Skaityti daugiau</button>
                            </Link>
                        </div>
                </div>
            </div>
        );
    }
}

Card.propTypes = {
    academy: PropTypes.shape({
        academy_id: PropTypes.number,
        academy_logo: PropTypes.string,
        academy_name: PropTypes.string,
        academy_description: PropTypes.string,
        academy_email: PropTypes.string,
        academy_price: PropTypes.object,
        academy_url: PropTypes.string,
    })
};

export default Card;
