import React, { Component } from 'react';
import { connect } from "react-redux";
import PropTypes from "prop-types";
import { getAllAcademies } from "../thunks";
import List from './List';
import Filters from "./Filters/Filters";

class Home extends Component {
    componentDidMount() {
        const { getAcademies, academies } = this.props;

        if (academies.length === 0)  getAcademies();
    }

    render() {
        const { academies, filteredAcademies } = this.props;

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
                            academies={filteredAcademies.length !== 0 ? filteredAcademies : academies}
                        />
                    )

                }
            </div>
        );
    }
}

Home.propTypes = {
    academies: PropTypes.array,
    filteredAcademies: PropTypes.oneOfType([
        PropTypes.string,
        PropTypes.array
    ]),
    getAcademies: PropTypes.func
}

const mapStateToProps = (state) => ({
    academies: state.academies.academies,
    filteredAcademies: state.academies.filteredAcademies,
});
const mapDispatchToProps = (dispatch) => ({
    getAcademies: () => dispatch(getAllAcademies()),
});

export default connect(
    mapStateToProps,
    mapDispatchToProps,
)(Home);

