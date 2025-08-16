import React from "react";
import {getTranslations} from "@/utils/functions";
import Social from "@/components/ui/Social";

const Footer = async ({locale}: { locale: string }) => {
    const translation = await getTranslations(locale);
    const currentYear = new Date().getFullYear();

    return (
        <footer className="flex flex-col space-y-10 justify-center m-10">
            <Social />
            <nav className="flex justify-center flex-wrap gap-6 text-gray-700 font-medium">
                <a className="hover:text-gray-900" href={`/${locale}/impressum`} target="_blank">{translation.title.impressum}</a>
            </nav>
            <p className="text-center font-medium">&copy; {currentYear}. {translation.text.footer}</p>
        </footer>
    );
};

export default Footer;
