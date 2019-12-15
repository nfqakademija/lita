import React, {Component} from 'react';
import PropTypes from "prop-types";

class Rating extends Component {
    state = {
        averageRating: 0,
        totalReviews: 0,
        fiveStarsReviews: 0,
        fourStarsReviews: 0,
        threeStarsReviews: 0,
        twoStarsReviews: 0,
        oneStarReviews: 0
    };

    componentDidMount() {
        this.getAverageRating();
    }

    getAverageRating = () => {
        const { programs } = this.props;
        let reviewCount = 0;
        let oneStarReviews = 0;
        let twoStarsReviews = 0;
        let threeStarsReviews = 0;
        let fourStarsReviews = 0;
        let fiveStarsReviews = 0;
        const totalRating = programs.reduce((total, program) => {
            const programRating = program.program_reviews
                .reduce((programTotal, review) => {
                    reviewCount++;
                    const rating = parseInt(review.rating,10);
                    if (rating === 1) oneStarReviews++;
                    if (rating === 2) twoStarsReviews++;
                    if (rating === 3) threeStarsReviews++;
                    if (rating === 4) fourStarsReviews++;
                    if (rating === 5) fiveStarsReviews++;
                    return programTotal + rating;
                }, 0);

            return total + programRating;
        }, 0);

        this.setState({
            averageRating: Math.round(totalRating / reviewCount).toFixed(1),
            totalReviews: reviewCount,
            oneStarReviews,
            twoStarsReviews,
            threeStarsReviews,
            fourStarsReviews,
            fiveStarsReviews
        });
    };

    getPercentageOfReviews = (amountOfReviews) => {
        if (amountOfReviews === 0) {
            return 0;
        }

        return Math.round(amountOfReviews / this.state.totalReviews * 100).toFixed(0)
    };

    render() {
        const {
            averageRating,
            totalReviews,
            fiveStarsReviews,
            fourStarsReviews,
            threeStarsReviews,
            twoStarsReviews,
            oneStarReviews
        } = this.state;

        return (
            <div className="row">
                <div className="col-12">
                    <div className="well well-sm">
                        <div className="row">
                            <div className="col-xs-12 col-md-6 text-center">
                                <h1 className="rating-num">
                                    {averageRating}</h1>
                                <div className="rating">
                                    <span className="glyphicon glyphicon-star"></span><span
                                    className="glyphicon glyphicon-star">
                            </span><span className="glyphicon glyphicon-star"></span><span
                                    className="glyphicon glyphicon-star">
                            </span><span className="glyphicon glyphicon-star-empty"></span>
                                </div>
                                <div>
                                    <span className="glyphicon glyphicon-user"></span>{totalReviews} atsiliepimų
                                </div>
                            </div>
                            <div className="col-xs-12 col-md-6">
                                <div className="row rating-desc">
                                    <div className="col-xs-3 col-md-3 text-right">
                                        <span className="glyphicon glyphicon-star"></span>5
                                    </div>
                                    <div className="col-xs-8 col-md-9">
                                        <div className="progress progress-striped">
                                            <div className="progress-bar progress-bar-success" role="progressbar"
                                                 aria-valuenow="20"
                                                 aria-valuemin="0"
                                                 aria-valuemax="100"
                                                 style={{width: `${this.getPercentageOfReviews(fiveStarsReviews)}%`}}
                                            >
                                                <span className="sr-only">80%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="col-xs-3 col-md-3 text-right">
                                        <span className="glyphicon glyphicon-star"></span>4
                                    </div>
                                    <div className="col-xs-8 col-md-9">
                                        <div className="progress">
                                            <div className="progress-bar progress-bar-success" role="progressbar"
                                                 aria-valuenow="20"
                                                 aria-valuemin="0"
                                                 aria-valuemax="100"
                                                 style={{width: `${this.getPercentageOfReviews(fourStarsReviews)}%`}}
                                            >
                                                <span className="sr-only">60%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="col-xs-3 col-md-3 text-right">
                                        <span className="glyphicon glyphicon-star"></span>3
                                    </div>
                                    <div className="col-xs-8 col-md-9">
                                        <div className="progress">
                                            <div className="progress-bar progress-bar-info" role="progressbar"
                                                 aria-valuenow="20"
                                                 aria-valuemin="0"
                                                 aria-valuemax="100"
                                                 style={{width: `${this.getPercentageOfReviews(threeStarsReviews)}%`}}
                                            >
                                                <span className="sr-only">40%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="col-xs-3 col-md-3 text-right">
                                        <span className="glyphicon glyphicon-star"></span>2
                                    </div>
                                    <div className="col-xs-8 col-md-9">
                                        <div className="progress">
                                            <div className="progress-bar progress-bar-warning" role="progressbar"
                                                 aria-valuenow="20"
                                                 aria-valuemin="0"
                                                 aria-valuemax="100"
                                                 style={{width: `${this.getPercentageOfReviews(twoStarsReviews)}%`}}
                                             >
                                                <span className="sr-only">20%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="col-xs-3 col-md-3 text-right">
                                        <span className="glyphicon glyphicon-star"></span>1
                                    </div>
                                    <div className="col-xs-8 col-md-9">
                                        <div className="progress">
                                            <div className="progress-bar progress-bar-danger" role="progressbar"
                                                 aria-valuenow="80"
                                                 aria-valuemin="0"
                                                 aria-valuemax="100"
                                                 style={{width: `${this.getPercentageOfReviews(oneStarReviews)}%`}}
                                            >
                                                <span className="sr-only">15%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

Rating.propTypes = {
    programs: PropTypes.array
};

export default Rating;
