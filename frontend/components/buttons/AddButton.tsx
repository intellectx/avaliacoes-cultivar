import React from 'react';
import {InertiaLink} from "@inertiajs/inertia-react";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faPlusCircle} from "@fortawesome/free-solid-svg-icons";
import {lang} from "../../lang";
import {Button} from "@themesberg/react-bootstrap";
import {ButtonProps} from "./ButtonProps";

export const AddButton: React.FC<ButtonProps> = (props) => {
  const { to, text, tipText } = props;
  const buttonText = text || lang('general.addButton');
  const buttonTipText = tipText || lang('general.addTip');

  return (
    <Button title={buttonTipText} as={InertiaLink} href={to} variant="primary" className="mb-4">
      <FontAwesomeIcon icon={faPlusCircle} className="me-2" /> {buttonText}
    </Button>
  );
};
