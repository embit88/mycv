import React from "react";
import appConfig from "@/appConfig";
import Link from "next/link";

const LanguageSelect = async ({url}: { url: string }) => {
    return (
        <div className="relative">
            <div className="flex space-x-4 right-5 top-3 absolute">
                {appConfig.locales.length > 0 ? (
                    appConfig.locales.map((locale, index) => (
                        <Link
                            href={`/${locale}/${url}`}
                            key={`select-lang-${index}`}
                            className="text-xs font-semibold flex justify-center hover:underline"
                        >
                            {locale.toUpperCase()}
                        </Link>
                    ))
                ) : null}
            </div>
        </div>
    );
};

export default LanguageSelect;
