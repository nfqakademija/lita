import React, { Component } from 'react';
import { connect } from "react-redux";
import PropTypes from "prop-types";
import List from './List';
import Filters from "./Filters/Filters";

class Home extends Component {
    render() {
        const { filteredAcademies } = this.props;

        return (
            <div className="container">
                <Filters />
                {typeof filteredAcademies === 'string'
                    ? (
                        <div className="row">
                            <div className="col-12 mt-3 alert alert-warning" role="alert">
                                Pagal pasirinktus kriterijus akademijų nerasta!
                            </div>
                        </div>
                    )
                    : (
                        <List
                            academies={filteredAcademies}
                        />
                    )

                }
            </div>
        );
    }
}

Home.propTypes = {
    filteredAcademies: PropTypes.oneOfType([
        PropTypes.string,
        PropTypes.array
    ]),
    filterAcademies: PropTypes.func
}

const mapStateToProps = (state) => ({
    filteredAcademies: state.academies.filteredAcademies,
});

export default connect(
    mapStateToProps
)(Home);

