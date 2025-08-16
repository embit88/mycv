import React from 'react';
import {getTranslations} from "@/utils/functions";
import appConfig from "@/appConfig";
import Footer from "@/components/ui/Footer";
import Social from "@/components/ui/Social";
import LanguageSelect from "@/components/ui/LanguageSelect";

interface Experience {
    name: string;
    profession: string;
    site?: string;
    data: string;
    text: string;
}

export async function generateMetadata({ params }: { params: Promise<{ locale: string }> }) {
    const translation = await getTranslations((await params).locale);

    return {
        title: translation.seo.meta_title,
        description: translation.seo.meta_description,
    };
}

export default async function Home({params}: { params: Promise<{ locale: string }> }) {
    const translation = await getTranslations((await params).locale);
    const experiences: Experience[] = Object.values(translation.experiences) as Experience[];

    return (
        <>
            <div className="container mx-auto py-8">
                <div className="grid grid-cols-4 lg:grid-cols-12 gap-6 px-4">
                    <div className="col-span-4 lg:col-span-3">
                        <div className="bg-white shadow rounded-xs p-6">
                            <div className="flex flex-col items-center">
                                {appConfig.image ? (
                                    <img src={appConfig.image}
                                         className="w-32 h-32 bg-gray-300 rounded-full mb-4 shrink-0" alt=""/>
                                ) : null}
                                <h1 className="text-xl text-gray-700 uppercase font-bold tracking-wider">{translation.info.name}</h1>
                                <p className="text-gray-600 text-sm m-2">{translation.info.profession}</p>
                                <a href={`mailto:${appConfig.email}`}
                                   className="text-gray-800 m-2 underline">{appConfig.email}</a>
                                <a href={`tel:${appConfig.phone}`}
                                   className="text-gray-800 m-2 underline">{appConfig.phone}</a>
                                <Social />
                            </div>
                            <hr className="my-6 border-t border-gray-300"/>
                            <div className="flex flex-col text-center">
                                <span
                                    className="text-gray-700 uppercase font-bold tracking-wider mb-2">{translation.title.skills}</span>
                                <ul>
                                    {translation.skills.map((skill: string) => (
                                        <li key={skill} className="mb-2">
                                            {skill}
                                        </li>
                                    ))}
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div className="col-span-4 lg:col-span-9">
                        <LanguageSelect url="" />
                        <div className="bg-white shadow rounded-xs p-6">
                            <h2 className="text-xl font-bold mb-4">{translation.title.about_me}</h2>
                            <p className="text-gray-700">
                                {translation.text.about_me}
                            </p>
                            <h2 className="text-xl font-bold mt-6 mb-4">{translation.title.experience}</h2>
                            {experiences.map((experience, index) => (
                                <div key={index} className="mb-6 mt-10">
                                    <div className="flex justify-between flex-wrap gap-2 w-full">
                                       <span className="text-gray-700 font-bold">
                                            {experience.profession} - {experience.name}{" "}
                                           {experience.site && (
                                               <>
                                                   (<a href={experience.site} target="_blank" rel="noreferrer nofollow"
                                                       className="text-gray-700 text-sm underline">
                                                   {experience.site}
                                               </a>)
                                               </>
                                           )}
                                       </span>
                                        <p>
                                            <span className="text-gray-700">{experience.data}</span>
                                        </p>
                                    </div>
                                    <p className="mt-2">{experience.text}</p>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>
            </div>
            <Footer locale={(await params).locale} />
        </>
    );
}
