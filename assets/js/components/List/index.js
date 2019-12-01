import React, { PureComponent, Fragment } from 'react';
import PropTypes from 'prop-types';
import { getExtendedAcademyInfo } from "../../services/api";
import Card from "../Card";
import Filters from "./Filters";
import Academy from "../Academy";

class List extends PureComponent {
    state = {
      extendedAcademyInfo: false
    };

    getExtendedAcademyInfo = async (extendedAcademyId) => {
        const extendedAcademyInfo = await getExtendedAcademyInfo(extendedAcademyId);
        this.setState({ extendedAcademyInfo });
    };

    cleanAcademyInfo = () => {
        this.setState({ extendedAcademyInfo: false });
    };

    render() {
        const { academies } = this.props;
        const { extendedAcademyInfo } = this.state;

        return (
            <Fragment>
                <Filters filterAcademies={this.props.filterAcademies} />
                <div className="row cards-list pt-5">
                    {academies.map((academy) => (
                        <div key={academy.academy_id} className="col-12 mb-5">
                            <Card academy={academy} showMoreInfo={this.getExtendedAcademyInfo} />
                        </div>
                    ))}
                </div>
                <Academy academyInfo={extendedAcademyInfo} cleanAcademyInfo={this.cleanAcademyInfo} />
            </Fragment>
        );
    }
}

List.propTypes = {
    academies: PropTypes.arrayOf(
        PropTypes.shape({
            academy_id: PropTypes.number,
        })
    ),
    filterAcademies: PropTypes.func
};

export default List;
